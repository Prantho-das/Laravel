<?php

namespace App\Http\Controllers;

use App\Events\CaseAssign;
use App\Models\assignCase;
use App\Models\caseImgs;
use App\Models\Caselist;
use App\Models\payment;
use App\Models\specilization_of_doctor;
use App\Models\User;
use App\Models\visitor;
use App\Providers\CaseAssignListener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class dashBoard extends Controller
{
    public function adminDashboard()
    {
        $case = assignCase::with('patientInfo', 'doctorInfo')->get();
        $pcase = Caselist::where('case_status', 0)->where('payment_status', 1)->count();
        $eCase = assignCase::where('case_status', 1)->count();
        $visitor = visitor::count();
        $doctor = user::where('role', "DOCTOR")->count();
        $patient = user::where('role', "PATIENT")->count();
        $earnTotal = payment::where('status', "Processing")->sum('amount');
        $data = [
            'doctor' => $doctor,
            'patient' => $patient,
            'visitor' => $visitor,
            'case' => $case,
            'pcase' => $pcase,
            'eCase' => $eCase,
            'earnTotal' => $earnTotal
        ];
        return view('admin.index', compact('data', $data));
    }
    public function doctorDashboard()
    {
        $doctorCase = User::with(['doctorCase' => function ($query) {
            $query->with('patientInfo')->get();
        }])
            ->with('doctorCase')
            ->where('id', auth()->id())->firstOrFail();

        $total = Caselist::where('case_status', 0)->where('payment_status', 1)->count();
        $evaluted = assignCase::where('doctor_id', auth()->id())->where('case_status', 1)->count();
        $pending = assignCase::where('doctor_id', auth()->id())->whereIn('case_status', [0, 2])->count();
        return view('doctor.index', [
            'patient' => $doctorCase,
            'total' => $total,
            'evaluted' => $evaluted,
            'pending' => $pending,
        ]);
    }

    public function patientDashboard()
    {
        $Case = Caselist::with('assignCase')->where("patient_id", auth()->user()->id)->get();

        $pending = Caselist::with('assign_cases')
            ->where('patient_id', '=', Auth::user()->id)
            ->where('Case_Status', 0)
            ->count();

        $evaluted = DB::table('caselists')
            ->where('caselists.patient_id', '=', Auth::user()->id)
            ->leftJoin('assign_cases', 'assign_cases.case_id', '=', 'caselists.id')
            ->where('assign_cases.case_status', '=', 1)
            ->count();
        $data = [
            'pending' => $pending,
            'evaluted' => $evaluted,
            'Case' => $Case,
        ];
        return view('patients.index', compact('data', $data));
    }
    public function profile()
    {
        return view('doctor_patient_profile');
    }

    public function profileShowDoctor($user)
    {
        $userInfo = User::where('u_id', $user)->firstOrFail();
        if ($userInfo->role === "DOCTOR") {
            $evaluted = assignCase::with('doctorInfo', 'caseList')->where('case_status', 1)->where('doctor_id', $userInfo->id)->get();
        }else {
            $evaluted = assignCase::with('doctorInfo', 'caseList')->whereIn('case_status', [0, 1])->where('patient_id', $userInfo->id)->get();
        }
        return view('individualProfile', [
            'evaluted' => $evaluted,
            'user' => $userInfo
        ]);
    }

    public function profileEdit(Request $req)
    {
        $req->validate([
            'f_name' => 'required|max:40',
            'l_name' => 'required|max:40',
            'phone' => 'required|digits_between:11,11|numeric',
            'age' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'f_name' => $req->f_name,
            'l_name' => $req->l_name,
            'phone' => $req->phone,
            'age' => $req->age,
            'gender' => $req->gender,
            'address' => $req->address,
        ]);
        session()->flash('msg', [
            'msg' => "Profile Updated",
            'active' => "info",
        ]);
        return back();
    }
    public function profilePassword(Request $req)
    {
        $req->validate([
            'password_current' => 'required',
            'password' => 'required|string|confirmed|min:8',
        ]);
        if (!Hash::check($req['password_current'], Auth::user()->password)) {
            session()->flash('msg', [
                'msg' => "Current Password Not Matched!",
                'active' => "error",
            ]);
            return back();
        } else {
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($req->password);
            session()->flash('msg', [
                'msg' => "Password Has Been Changed Successfully!",
                'active' => "success",
            ]);
        }
        return back();
    }
    public function doctorSpecialization(Request $req)
    {
        specilization_of_doctor::updateOrInsert(
            (array) array_merge(['doctor_id' => auth()->id()], $req->except('_token'))
        );
        session()->flash('msg', [
            'msg' => "Specialization Added",
            'active' => "success",
        ]);
        return back();
    }
    public function media(Request $req)
    {
        $imgUrl = null;

        if ($req->get('inbox')) {
            dd($req->get('inbox'));
        } elseif ($req->get('case')) {
            $img = caseImgs::findOrFail($req->case);
            $imgUrl = $img->case_img;
        } else {
            abort('404');
        }
        return view('imgPreview', compact('imgUrl'));
    }
}
