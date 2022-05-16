<?php

namespace App\Http\Livewire;

use App\Models\Inbox;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InboxNotify extends Component
{
    public function render()
    {
        $messageCount = Inbox::where('seen', 0)->where('receiver_id', auth()->id())->groupBy('case_id')->count();
        $messageList =
        Inbox::with('senderInfo', 'receiverInfo', 'caseInfo', 'assignInfo')
        ->where('sender_id', auth()->id())
        ->orWhere('receiver_id', auth()->id())
        ->latest()
        ->get()
        ->groupBy('case_id');

        return view('livewire.inbox-notify',[
            'messageCount'=> $messageCount,
            'messageList'=> $messageList
        ]);
    }
}
