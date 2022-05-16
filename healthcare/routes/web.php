<?php

use App\Http\Controllers\adminPatient;
use App\Http\Controllers\CaselistController;
use App\Http\Controllers\category;
use App\Http\Controllers\ContactAdminController;
use App\Http\Controllers\dashBoard;
use App\Http\Controllers\doctorCategoryController;
use App\Http\Controllers\helpEmail;
use App\Http\Controllers\patientController;
use App\Http\Controllers\prescriptionController;
use App\Http\Controllers\question;
use App\Http\Controllers\setting;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\subscription as ControllersSubscription;
use App\Models\subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/config', function () {
    Artisan::call("optimize");
    Artisan::call("view:clear");
    Artisan::call("config:clear");
    Artisan::call("route:clear");
    Artisan::call("config:cache");
    Artisan::call("route:cache");
    Artisan::call("view:cache");
    return response(['data' => "Configuration Done"], 200);
});

Route::get('/', function () {
    return view('welcome');
})->name('main');

Route::view('learning', 'admin.setting');

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    // payment
    Route::get('/pay-with-instalment/{case}', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);
    Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    // payment

    //admin start
    Route::group(['prefix' => 'admin', 'middleware' => 'role:ADMIN'], function () {
        Route::get('dashboard', [dashBoard::class, 'adminDashboard']);
        Route::get('case', [CaselistController::class, 'adminIndex']);
        Route::get('case_details/{id}', [CaselistController::class, 'admin_case_details']);
        Route::get('case_reassign_mail/{doctor}', [CaselistController::class, 'admin_case_reassign_mail']);
        Route::get('case_reassign/{assignCase}', [CaselistController::class, 'admin_case_reassign_doctor_disabled']);
        Route::resource('category', category::class);
        Route::view('doctor', 'admin.admin_doctors');
        Route::get('doctor/edit/{id}', [doctorCategoryController::class, 'editShow']);
        Route::post('doctor/update', [doctorCategoryController::class, 'edit'])->name('doctorEdit');
        Route::resource('patient', adminPatient::class);

        Route::get('email', [helpEmail::class, 'helpEmailIndex']);
        Route::get('email/show/{id}', [helpEmail::class, 'helpEmailShow']);
        Route::get('email/delete/{id}', [helpEmail::class, 'helpEmailDelete']);
        Route::post('email/show', [helpEmail::class, 'helpEmailSend'])->name('admin.email');

        Route::resource('symptom', question::class);
        Route::get('payment', [SslCommerzPaymentController::class, 'case_payment_admin']);
        Route::resource('subscription', ControllersSubscription::class);
        Route::resource('setting', setting::class);
    });

    Route::get('payment/invoice/{case}', [SslCommerzPaymentController::class, 'case_payment_admin_invoice']);
    //admin end

    //doctor start
    Route::group(['prefix' => 'doctor', 'middleware' => 'role:DOCTOR'], function () {
        Route::get('dashboard', [dashBoard::class, 'doctorDashboard']);
        Route::post('specialization', [dashBoard::class, 'doctorSpecialization'])->name('doctor.specialization');
        Route::get('case', [CaselistController::class, 'doctorIndex']);
        Route::get('case_details/{id}', [CaselistController::class, 'doctor_case_details']);
        Route::get('case_evaluated/{id}', [CaselistController::class, 'doctor_case_evaluted']);
        Route::get('patient', [patientController::class, 'doctorPatientIndex']);
        Route::post('prescription/{id}', [prescriptionController::class, 'prescriptionMake'])->name('doctorPrescription');
    });
    //doctor end

    //patient start
    Route::group(['prefix' => 'patient', 'middleware' => 'role:PATIENT'], function () {
        Route::get('dashboard', [dashBoard::class, 'patientDashboard']);
        Route::get('case', [CaselistController::class, 'patient_case']);
        Route::get('add_case/{id}', [CaselistController::class, 'patientIndex']);
        Route::post('add_case', [CaselistController::class, 'caseAdd']);
        Route::get('case_details/{id}', [CaselistController::class, 'case_details']);
        Route::post('case_details/imgAdd/{id}', [CaselistController::class, 'case_pic_add'])->name('case_pic_add');
        Route::get('payment', [SslCommerzPaymentController::class, 'case_payment_patient']);
    });
    //patient end

    //Profile
    Route::get('user_profile', [dashBoard::class, 'profile']);
    Route::post('user_profile', [dashBoard::class, 'profileEdit'])->name('profileEdit');

    Route::get('user_profile/{user}', [dashBoard::class, 'profileShowDoctor']);
    Route::get('case_details/{id}', [CaselistController::class, 'local_case_details']);

    Route::post('user_change_password', [dashBoard::class, 'profilePassword'])->name('profilePassword');
    //Profile
    Route::get('prescriptionPreview/{id}', [prescriptionController::class, 'prescriptionPreview']);
    Route::get('prescription/{id}', [prescriptionController::class, 'prescriptionEmail'])->name('prescription')->middleware('role:PATIENT');
    //help
    Route::resource('help', ContactAdminController::class);
    //help
    //media
    Route::get('media', [dashBoard::class, 'media']);
    //media
});
Route::post('subscription', function (Request $req) {
    $req->validate([
        'email' => 'required|unique:subscriptions|email',
    ], [
        'email.unique' => 'You Are Subscribed',
    ]);
    subscription::create([
        'id' => uniqid(),
        'email' => $req->email,
    ]);
    session()->flash('msg', [
        'active' => 'success', 'msg' => 'We Will Send You Newsletter',
    ]);
    return back();
})->name('subscription');
