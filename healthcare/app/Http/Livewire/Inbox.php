<?php

namespace App\Http\Livewire;

use App\Models\Inbox as ModelsInbox;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Inbox extends Component
{
    public $caseId;
    public $caseDet;
    public $textMessage;
    public function mount($caseDet)
    {
        $this->caseId = $caseDet->id;
        $this->caseDet = $caseDet;
    }

    public function send()
    {
        
        $this->validate([
            'textMessage' => 'required'
        ]);

        $this->seen();

        if ($this->caseDet->patientInfo->id === Auth::user()->id) {
            $receiverId = $this->caseDet->assignCase->id;
        } else {
            $receiverId = $this->caseDet->patientInfo->id;
        }

        ModelsInbox::insert([
            'case_id' => $this->caseId,
            'sender_id' => Auth::user()->id,
            'receiver_id' => $receiverId,
            'message' => $this->textMessage,
            'sent_time' => now(),
            'created_at' => now(),
        ]);
        $this->reset('textMessage');
         $this->emit('frontInputClear');
    }
    public function render()
    {
        $allMessage = ModelsInbox::with(['senderInfo', 'receiverInfo'])->where('case_id', $this->caseId)->get();
        $this->emit('MessageScroll');
        return view(
            'livewire.inbox',
            ['allMessage' => $allMessage]
        );
    }
    public function seen(){
        $seen = ModelsInbox::
          where('case_id', $this->caseId)
        ->where('seen', 0)
        ->where('sender_id','!=',Auth::user()->id)
        ->get();
        foreach ($seen as $value) {
            $value->seen = 1;
            $value->save();
        }
        return true;
    }
}
