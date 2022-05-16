<?php

namespace App\Http\Livewire;

use App\Models\doctorCategory;
use App\Models\question;
use Livewire\Component;

class QuestionList extends Component
{
    public $question;
    public $catId;
    public function questionList()
    {
        $this->validate([
            'catId' => 'required|numeric'
        ], [
            'catId.numeric' => 'Please Select a Field'
        ]);
        $this->question = question::where('category_id', $this->catId)
            ->whereYear('created_at', date('Y'))->get();
    }
    public function questionListDelete($id)
    {
        $question = question::findOrFail($id);
        $question->delete();
        session()->flash('msg', ['active' => 'success', 'msg' => "Sysmptop Successfully Deleted"]);
        $this->question = question::where('category_id', $this->catId)
            ->whereYear('created_at', date('Y'))->get();
    }
    public function render()
    {
        $category = doctorCategory::all();
        return view('livewire.question-list', ['category' => $category]);
    }
}
