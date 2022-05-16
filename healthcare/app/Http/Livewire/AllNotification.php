<?php

namespace App\Http\Livewire;

use Livewire\Component;
class AllNotification extends Component
{
    public $notification;
    public function read_at(){
        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
    }
    public function render()
    {
        $this->notification=count(auth()->user()->unreadNotifications);
        return view('livewire.all-notification');
    }
}
