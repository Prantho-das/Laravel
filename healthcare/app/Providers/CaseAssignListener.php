<?php

namespace App\Providers;

use App\Events\CaseAssign;
use App\Models\assignCase;
use App\Models\Caselist;
use App\Models\doctorStatus;
use App\Models\User;
use App\Notifications\allNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class CaseAssignListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CaseAssign  $event
     * @return void
     */
    public function handle(CaseAssign $event)
    {
        $caseList = Caselist::where('case_status', 0)->where('payment_status', 1)->oldest()->first();

        if (!empty($caseList)) {
            $doctor = User::join('doctor_statuses', 'doctor_statuses.doctor_id', 'users.id')
                ->join('doctor_category_assigns', 'user_id', 'doctor_statuses.doctor_id')
                ->where('users.status', 1)
                ->where('doctor_statuses.doctor_status', 0)
                ->where('doctor_category_assigns.category_id', $caseList->category_id)
                ->where('role', 'DOCTOR')
                ->orderBy('doctor_statuses.last_case', 'asc')
                ->first();
            if (!empty($doctor)) {
                $caseList->update([
                    'case_status' => 1,
                ]);
                assignCase::create([
                    'case_id' => $caseList->id,
                    'doctor_id' => $doctor->doctor_id,
                    'patient_id' => $caseList->patient_id,
                    'assign_date' => now(),
                    'created_at' => now()
                ]);
                doctorStatus::where('doctor_id', $doctor->doctor_id)
                    ->update([
                        'doctor_status' => 1
                    ]);
                $link = "doctor/case_details/" . encrypt($caseList->id);
                Notification::send(User::find($doctor->doctor_id), new allNotification("You Have New Case", $link));
            }
        }
    }
}

// $doctor = DB::table('users')
//     ->where('role', 'DOCTOR')
//     ->where('status', 1)
//     ->Join("doctor_statuses", "users.id", 'doctor_statuses.doctor_id')
//     ->Join("loginfos", "users.id", 'loginfos.user_id')
//     ->where('doctor_statuses.doctor_status', '0')
//     ->orderBy('doctor_statuses.last_case', 'asc')
//     ->limit(1)
//     ->get();

// $caseList = Caselist::where('case_status', 0)->where('payment_status', 1)->oldest()->first();
// if (count($doctor) > 0) {
//     if (!empty($caseList)) {
//         $caseList->update([
//             'case_status' => 1,
//         ]);
//         assignCase::create([
//             'case_id' => $caseList->id,
//             'doctor_id' => $doctor[0]->doctor_id,
//             'patient_id' => $caseList->patient_id,
//             'assign_date' => now(),
//             'created_at' => now()
//         ]);
//         doctorStatus::findOrFail($doctor[0]->id)->update([
//             'doctor_status' => 1
//         ]);
//     }
// }