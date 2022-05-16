<?php

namespace App\View\Components;

use App\Models\payment;
use Illuminate\View\Component;

class earningChart extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $current=[];
    public $previous=[];
    public function __construct()
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        for ($i=1; $i <= 12; $i++) { 
            array_push($this->current,payment::whereMonth('created_at',$i)->whereYear('created_at',date('Y'))->sum('amount'));
        }
        
        for ($i=1; $i <= 12; $i++) { 
            array_push($this->previous,payment::whereMonth('created_at',$i)->whereYear('created_at',date('Y')-1)->sum('amount'));
        }
        return view('components.earning-chart');
    }
}
