<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Avatar extends Component
{
    use WithFileUploads;

    public $photo;
    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'mimes:png,jpg,jpeg|image|max:1024', // 1MB Max
        ]);
    }
    public function save()
    {
        $this->validate([
            'photo' => 'mimes:png,jpg,jpeg|image|max:1024', // 1MB Max
        ]);
        $avatar_name = 'Medi' . time() . '.' . $this->photo->getClientOriginalExtension();
        $user = User::findOrFail(Auth::user()->id);
        $user->avatar = $avatar_name;
        $user->save();
        $this->photo->storeAs('image', $avatar_name, 'public');
        $this->reset();
        session()->flash('msg', ['active' => 'success', 'msg' => "Avatar Is Changed Successfully"]);
        return redirect()->to('user_profile');
    }
    public function render()
    {
        return view('livewire.avatar');
    }
}
