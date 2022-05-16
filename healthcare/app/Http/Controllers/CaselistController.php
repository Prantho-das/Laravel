<?php

namespace App\Http\Controllers;

use App\Events\CaseAssign;
use App\Models\assignCase;
use App\Models\caseImgs;
use App\Models\Caselist;
use App\Models\doctorCategory;
use App\Models\doctorStatus;
use App\Models\question;
use App\Models\setting;
use App\Models\User;
use App\Notifications\allNotification;
use App\Notifications\caseWarning;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CaselistController extends Controller
{


    public $setting;

    //? Case--------------------------------------------------------------------

    // patients case details and other things
    public function __construct()
    {
        $this->setting = setting::firstOrFail();
    }

    public function patientIndex($id)
    {
        $catId = doctorCategory::findOrFail(decrypt($id));
        $question = question::where('category_id', $catId->id)->whereYear('created_at', date('Y'))->get();
        return view('patients.patient_add_new_case', [
            'catId' => $catId,
            'question' => $question
        ]);
    }
    public function patient_case()
    {
        $Case = Caselist::with('assignCase')->where('patient_id',auth()->id())->get();
        return view('patients.patients_cases', compact('Case', $Case));
    }

    public function case_details(Request $req, $id)
    {
        $casedet = Caselist::with(['caseImg', 'assignCase', 'patientInfo', 'categoryInfo', 'prescription', 'paymentInfo'])
            ->findOrFail(decrypt($id));
        $catQuestion = question::where('category_id', $casedet->category_id)->get();
        return view('patients.patients_case_details', [
            'question' =>
            $catQuestion
        ])->with('caseDet', $casedet);
    }
    public function case_pic_add(Request $req, $id)
    {
        $req->validate([
            'images' => 'required'
        ]);
        if ($id) {
            if ($req->images) {
                $case_img_add = $this->caseImg($id, $req->file('images'));
                if (!$case_img_add) {
                    return abort(404);
                }
            }
        }
        return back();
    }

    // patients case details and other things



    // Doctor case details and other things

    public function doctorIndex()
    {
        $evaluted = assignCase::with(['caseList', 'patientInfo'])
            ->where('doctor_id', Auth::user()->id)
            ->where('case_status', 1)
            ->orWhere('case_status', 2)
            ->get();
        $pending = assignCase::with(['caseList', 'patientInfo'])
            ->where('doctor_id', Auth::user()->id)
            ->where('case_status', 0)
            ->get();
        return view('doctor.doctor_cases', compact('pending', $pending))
            ->with('evaluted', $evaluted);
    }


    public function doctor_case_details($id)
    {
        $caseDet = Caselist::with(['caseImg', 'patientInfo', 'assignCase', 'categoryInfo'])
            ->where('id', decrypt($id))
            ->firstOrFail();
        $catQuestion = question::where('category_id', $caseDet->category_id)->get();
        return view('doctor.doctor_unevaluated_case_details', ['caseDet' => $caseDet, 'question' => $catQuestion]);
    }
    public function local_case_details($id)
    {
        $caseDet = Caselist::with(['caseImg', 'patientInfo', 'assignCase', 'categoryInfo'])
            ->where('id', decrypt($id))
            ->firstOrFail();
        $catQuestion = question::where('category_id', $caseDet->category_id)->get();
        return view('patientLocalCaseDetails', ['caseDet' => $caseDet, 'question' => $catQuestion]);
    }


    public function doctor_case_evaluted($id)
    {
        $caseDet = Caselist::with(['caseImg', 'patientInfo', 'assignCase'])
            ->where('id', decrypt($id))
            ->firstOrFail();
        return view('doctor.doctor_evaluated_case_details', ['caseDet' => $caseDet]);
    }

    // Doctor case details and other things



    // Admin case details and other things
    public function adminIndex()
    {
        $pending = Caselist::with('patientInfo')
            ->where('case_status', 0)
            ->where('payment_status', 1)
            ->get();

        $evaluted = assignCase::with(['caseList', 'doctorInfo'])
            ->where('case_status', 1)
            ->orWhere('case_status', 2)
            ->get();

        $inProgress = assignCase::with(['doctorInfo', 'patientInfo'])
            ->where('case_status', 0)
            ->get();

        $case = assignCase::where('case_status', 0)->with(['doctorInfo', 'patientInfo'])->oldest('assign_date')->get();
        $reassign = $case->filter(function ($item) {
            return (Carbon::make($item->assign_date)->diffInDays() >= $this->setting->reassignDay);
        });

        return view(
            'admin.admin_cases',
            [
                'pending' => $pending,
                'evaluted' => $evaluted,
                'inProgress' => $inProgress,
                'reassign' => $reassign
            ]
        );
    }
    public function admin_case_reassign_mail(User $doctor)
    {
        $doctor->notify(new caseWarning());
        session()->flash('msg', [
            'active' => 'success', 'msg' => 'Warn Message Sent',
        ]);
        return back();
    }
    public function admin_case_reassign_doctor_disabled(assignCase $assignCase)
    {
        $doctor = User::findOrFail($assignCase->doctor_id);
        $doctor->status = 0;
        $doctor->save();

        $doctorStatus = doctorStatus::where('doctor_id', $assignCase->doctor_id)->firstOrFail();
        $doctorStatus->doctor_status = 0;
        $doctorStatus->save();

        $case = Caselist::findOrFail($assignCase->case_id);
        $case->case_status = 0;
        $case->save();

        $assignCase->delete();

        event(new CaseAssign());

        session()->flash('msg', [
            'active' => 'info', 'msg' => 'Case Reassigned & Doctor Disabled',
        ]);
        return back();
    }

    public function admin_case_details($id)
    {
        $caseDet = Caselist::with(['caseImg', 'patientInfo', 'assignCase', 'categoryInfo'])
            ->where('id', decrypt($id))
            ->firstOrFail();
        $catQuestion = question::where('category_id', $caseDet->category_id)->get();
        return view('admin._admin_case_details',
            [
                'caseDet' => $caseDet,
                'question' => $catQuestion
            ]
        );
    }
    // Admin case details and other

    //? Case--------------------------------------------------------------------

    public function caseAdd(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'images.*' => 'sometimes|mimes:png,jpg,jpeg|image|max:1024',
        ]);
        $case_id = Caselist::insertGetId([
            'patient_id' => Auth::user()->id,
            'category_id' => $request->cat_id,
            'description' => $request->description,
            'symptom_one' => $request->input(1) ? $request->input(1) : "N/A",
            'symptom_two' => $request->input(2) ? $request->input(2) : "N/A",
            'symptom_three' => $request->input(3) ? $request->input(3) : "N/A",
            'symptom_four' => $request->input(4) ? $request->input(4) : "N/A",
            'symptom_five' => $request->input(5) ? $request->input(5) : "N/A",
            'symptom_six' => $request->input(6) ? $request->input(6) : "N/A",
            'symptom_seven' => $request->input(7) ? $request->input(7) : "N/A",
            'symptom_eight' => $request->input(8) ? $request->input(8) : "N/A",
            'symptom_nine' => $request->input(9) ? $request->input(9) : "N/A",
            'symptom_ten' => $request->input(10) ? $request->input(10) : "N/A",
            'created_at' => now(),
        ]);
        if ($case_id) {
            if ($request->images) {
                $case_img_add = $this->caseImg($case_id, $request->file('images'));
                if (!$case_img_add) {
                    return abort(404);
                }
            }
        }
        $casePrice = doctorCategory::findOrFail($request->cat_id);

        session()->flash('msg', [
            'active' => 'success', 'msg' => 'Case is Done',
            'case_id' => encrypt($case_id),
            'casePrice' => $casePrice->case_price
        ]);

        $admin=User::where('role','ADMIN')->get();
        Notification::send($admin,new allNotification("New Case Added","admin/case"));


        return redirect()->back();
    }

    protected function caseImg($caseId, $img)
    {
        try {
            foreach ($img as $images) {
                $imgName = 'MEDI_CASE' . uniqid() . time() . '.' . $images->getClientOriginalExtension();
                $caseImg = caseImgs::create([
                    'case_id' => $caseId,
                    'case_img' => $imgName,
                ]);
                $images->move(public_path() . '/storage/image/', $imgName);
            }
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }
}
