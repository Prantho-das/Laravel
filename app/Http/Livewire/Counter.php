<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Counter extends Component
{
    use WithFileUploads;
    public $comment;
    public $number = 0;
    public $photo;
    public $data = [];


    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
        $name = 'livewire' . '.' . $this->photo->getClientOriginalExtension();
        $this->photo->storeas('public', $name);
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, ['comment' => 'required|min:6',]);
    }
    public function delete($id)
    {
        $this->data = array_splice($this->data, $id, 1);
    }
    public function updatedData()
    {
        $this->number++;
    }
    public function comment()
    {
        $this->validate([
            'comment' => 'required|min:6',
        ]);
        array_push($this->data, [
            'title' => $this->comment,
            'description' => 'prantho is a good boy'
        ]);
        $this->comment = '';
    }
    public function increment()
    {
        $this->number++;
    }
    public function decrement()
    {
        if ($this->number <= 0) {
            $this->number = 0;
        } else {
            $this->number--;
        }
    }
    public function render()
    {
        return view('livewire.counter');
    }
}
