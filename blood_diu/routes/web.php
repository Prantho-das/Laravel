<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BloodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => 7.0,
        'phpVersion' => PHP_VERSION,
    ]);
});


require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    Route::middleware('info')->group(function () {
        Route::get('/dashboard', function () {
            $totalUser=User::count();
            $totalDonor=User::where('blood_status','1')->count();
            return Inertia::render('Dashboard',['totalDonor'=>$totalDonor,'totalUser'=>$totalUser]);
        })->name('dashboard');
        Route::get('/information', function () {
            return inertia('Information');
        })->name('information');
        Route::get('about', fn() => Inertia::render('About'))->name('about');
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('information',[AuthenticatedSessionController::class,"info"])->name('information');
        Route::get('donate_history',[BloodController::class,"history"])->name('donate.history');

        Route::get('donate_request',[BloodController::class,"request"])->name('donate.request');
        Route::post('donate_request',[BloodController::class,"requestPost"])->name('donate.requestPost');
        Route::delete('donate_request',[BloodController::class,"requestDelete"])->name('donate.requestDelete');
        Route::put('donate_request',[BloodController::class,"requestStatusUpdate"])->name('donate.requestStatusUpdate');

        Route::get('notifaction',function (){return auth()->user()->unreadNotifications;})->name('notification');
        Route::post('notifaction',function (){
            auth()->user()->unreadNotifications->markAsRead();
            return auth()->user()->notifications;
        })->name('notification.read');
    });
});
