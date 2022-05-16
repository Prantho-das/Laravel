<?php

namespace App\View\Components;

use App\Http\Controllers\category;
use App\Models\doctorCategory;
use Illuminate\View\Component;

class welcomeCategory extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $category;
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
        $this->category = doctorCategory::where('category_status', 0)->get();
        return view('components.welcome-category');
    }
}
