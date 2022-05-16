<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class welcomeTeam extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    //public $team;

    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        // $this->team = User::where('role','DOCTOR')->with('specialization')->get();
        $team = User::where('role', 'DOCTOR')->where('status', 1)->with('specialization')->get();
        return view('components.welcome-team',compact('team'));
    }
}
