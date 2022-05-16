<?php

namespace App\Http\Livewire;

use App\Events\CaseAssign;
use App\Models\assignCase;
use App\Models\doctorStatus;
use App\Models\User;

use Livewire\Component;
use App\Mail\caseStatusMail;
use App\Models\Inbox;
use App\Notifications\allNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class DoctorActiveSafe extends Component
{
    public $case;
    protected $listeners = ['refresh' => '$refresh'];
    public function safe($id)
    {
        $case = assignCase::where('case_id', $id)->with('doctorInfo', 'descriptionInfo')->firstOrFail();
        $case->case_status = 1;
        $case->release_date = now();
        $case->save();
        doctorStatus::where('doctor_id', auth()->id())->update([
            'doctor_status' => 0,
            'last_case' => now()
        ]);
        event(new CaseAssign());
        $email = User::findOrFail($case->patient_id)->email;
        $seen = Inbox::where('case_id', $id)
            ->where('seen', 0)
            ->get();
        foreach ($seen as $value) {
            $value->seen = 1;
            $value->save();
        }
        $link = "case_details/" . encrypt($id);
        $patient = User::find($case->patient_id);
        Notification::send($patient, new allNotification("Case Finished", $link));
        try {
            Mail::to($email)->send(new caseStatusMail($case));
        } catch (\Throwable $th) {
            return abort(404);
        }

        session()->flash('msg', [
            'msg' => "Patient Safe",
            'active' => "error",
        ]);
        return redirect('doctor/case');
    }
    public function unClear($id)
    {
        $case = assignCase::where('case_id', $id)->with('doctorInfo', 'paymentInfo')->firstOrFail();
        $case->case_status = 2;
        $case->save();
        doctorStatus::where('doctor_id', auth()->id())->update([
            'doctor_status' => 0,
            'last_case' => now()
        ]);
        event(new CaseAssign());
        $email = User::findOrFail($case->patient_id)->email;
        Mail::to($email)->send(new caseStatusMail($case));
        $this->emitSelf('refresh');
        $link = "case_details/" . encrypt($id);
        $patient = User::find($case->patient_id);
        Notification::send($patient, new allNotification("Case Unclear", $link));
        session()->flash('msg', [
            'msg' => "Unclear",
            'active' => "error",
        ]);
    }

    public function mount($case)
    {
        $this->case = $case;
    }
    public function render()
    {
        return view('livewire.doctor-active-safe');
    }
}
