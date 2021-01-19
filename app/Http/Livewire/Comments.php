<?php

namespace App\Http\Livewire;

use App\Models\comment;
use App\Models\post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Comments extends Component
{
    use WithFileUploads;
    public $comments;
    public $comment_img;
    protected $imgName;
    public $post_id = 1;
    public function updated($fields)
    {
        $this->validateOnly(
            $fields,
            ['comments' => 'required|min:6', 'comment_img' => 'nullable|mimes:png,jpg|max:2024',]
        );
    }
    public function postSelect($id)
    {
        $this->post_id = $id;
        $message = [
            'msg' => "Post Selected",
            'active' => "bg-blue-500"
        ];
        session()->flash('msg', $message);
    }
    public function comment()
    {
        $this->validate([
            'comments' => 'required|min:6',
            'comment_img' => 'nullable|mimes:png,jpg|max:2024',
        ]);
        if ($this->comment_img) {
            $this->imgName = 'Pra' . time() . '.' . $this->comment_img->getClientOriginalExtension();
            $this->comment_img->storeas('public/image', $this->imgName);
        }
        comment::create([
            'post_id' => $this->post_id,
            'comments' => $this->comments,
            "comment_img" => $this->imgName,
            'created_at' => Carbon::now()
        ]);
        $this->comments = '';
        $this->comment_img = '';
        $message = [
            'msg' => "Comment Inserted",
            'active' => "bg-green-500"
        ];
        session()->flash('msg', $message);
    }
    public function delete($delId)
    {
        $path = 'storage/image/';
        $comments = comment::find($delId);
        if ($comments->comment_img) {
            if (file_exists(public_path($path . $comments->comment_img))) {
                unlink($path . $comments->comment_img);
            }
        }
        $comments->delete();
        $message = [
            'msg' => "Comment Deleted",
            'active' => "bg-red-500"
        ];
        session()->flash('msg', $message);
    }
    public function render()
    {
        $comment = comment::where('post_id', $this->post_id)->latest()->paginate(4);
        $post = post::latest()->paginate(4);
        return view('livewire.comments', compact('comment', 'post'));
    }
}
