<?php

namespace App\View\Components;

use App\Models\payment;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class adminPayment extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $payment;
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
        $this->payment =
        DB::table('payments')
        ->where('payments.status', 'Processing')
        ->join('caselists', 'caselists.id', '=', 'payments.case_id')
        ->join('doctor_categories', 'doctor_categories.id', 'caselists.category_id')
        ->join('users','users.id','caselists.patient_id')
        ->select('payments.*','users.u_id','caselists.*','doctor_categories.*')
        ->get();
        return view('components.admin-payment');
    }
}
