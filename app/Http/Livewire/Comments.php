<?php

namespace App\Http\Livewire;

use App\Comment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Comments extends Component
{


    use WithFileUploads;
    use WithPagination;
    public $newComment;
    public $photo;

    public function mount()
    {

//        $this->comments = $initialComments;
    }


    public function addComment()
    {

        $this->validate([
            'newComment' => 'required|max:255',
            'photo' => 'image|max:1024',
        ]);

        Comment::create(['body' => $this->newComment, 'user_id' => auth()->user()->id]);
        $this->photo->store('public/avatar');
        $this->newComment = "";
        session()->flash('message', 'Comment Successfully Added');
    }

    public function remove($commentID){
        Comment::find($commentID)->delete();
        session()->flash('message', 'Comment Successfully Deleted');
    }

    public function render()
    {
        return view('livewire.comments',[
            'comments' => Comment::latest()->paginate(5),
        ]);
    }
}
