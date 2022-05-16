<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class patientGender extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $male;
    public $female;
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
        $this->male = User::where('gender', 'male')->where('role', 'PATIENT')->count();
        $this->female = User::where('gender', 'female')->where('role', 'PATIENT')->count();
        return view('components.patient-gender');
    }
}
