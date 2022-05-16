<?php

namespace App\View\Components;

use App\Models\prescription as ModelsPrescription;
use Illuminate\View\Component;

class prescription extends Component
{
    public $caseId;
    public $caseDet;
    public $prescription;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($caseDet)
    {
        $this->caseId = decrypt(request('id'));
        $this->caseDet = $caseDet;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $this->prescription = ModelsPrescription::where('case_id', $this->caseId)->first();
        return view('components.prescription');
    }
}
