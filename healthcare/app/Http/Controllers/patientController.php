<?php

namespace App\Http\Controllers;

use App\Models\assignCase;
use App\Models\User;
use Illuminate\Http\Request;

class patientController extends Controller
{

    public function doctorPatientIndex()
    {
        $doctorCase = User::with(['doctorCase'=>function ($query) {
            $query->with('patientInfo')->get();
        }])->with('doctorCase')->where('id', auth()->id())->firstOrFail();
        return view('doctor.doctor_patients', ['patient' => $doctorCase]);
    }
}
