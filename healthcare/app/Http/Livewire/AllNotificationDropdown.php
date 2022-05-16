<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AllNotificationDropdown extends Component
{
    public $notification;
    public function render()
    {
       $this->notification= auth()->user()->notifications;
        return view('livewire.all-notification-dropdown');
    }
}
