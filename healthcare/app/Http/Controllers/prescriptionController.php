<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\assignCase;
use App\Models\prescription;
use App\Models\User;
use App\Notifications\allNotification;
use PDF;
use Illuminate\Http\Request;

class prescriptionController extends Controller
{
    public function prescriptionMake(Request $req, $id)
    {
        $req->validate([
            'disease' => 'required',
            'medicine' => 'required',
            'prescription' => 'required'
        ]);
        $prescription = prescription::where('case_id', $id)->first();
        if ($prescription) {
            $prescription->disease = $req->disease;
            $prescription->medicine = $req->medicine;
            $prescription->note = $req->prescription;
            $prescription->save();
            $case = assignCase::where('case_id', $id)->firstOrFail();
            $doctor = User::find($case->patient_id);
            $link = "prescriptionPreview/" . $prescription->id;
        } else {
            $prescription = prescription::create([
                'case_id' => $id,
                'disease' => $req->disease,
                'medicine' => $req->medicine,
                'note' => $req->prescription
            ]);
            $case = assignCase::where('case_id', $id)->firstOrFail();
            $doctor = User::find($case->patient_id);
            $link = "prescriptionPreview/" . $prescription->id;
        }
        $doctor->notify(new allNotification("Prescription Added", $link));

        session()->flash('msg', [
            'active' => 'success', 'msg' => 'Prescription Added',
        ]);
        return back();
    }



    public function prescriptionPreview($id)
    {
        $data = prescription::with('assign_info')->where('case_id', $id)->firstOrFail();
        $patient = User::find($data->assign_info->patient_id);
        return view('doctor.prescriptionPreview', ['data' => $data, 'patient' => $patient]);
    }
    public function prescriptionEmail(Request $request, $id)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }
        $data = prescription::with('assign_info')->where('case_id', $id)->firstOrFail();
        $patient = User::find($data->assign_info->patient_id);
        $pdf = PDF::loadView('doctor.prescription', ['data' => $data, 'patient' => $patient]);

        return $pdf->stream();
    }
}
