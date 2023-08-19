<?php

namespace App\Http\Livewire\Modals;

use App\Models\Post;
use LivewireUI\Modal\ModalComponent;

class DeletePost extends ModalComponent
{
    public $postId;
    public function render()
    {
        $post = Post::select('id', 'title')->where('id', $this->postId)->first();
        return view('livewire.modals.delete-post')->with('post', $post);
    }

    public function updated()
{
    $this->dispatchBrowserEvent('reinitDataTable');
}


    public function confirmDeletePost(){
        $post = Post::where('id', $this->postId)->first();
        $confirm = $post->delete();
        if($confirm){
            $this->emit('postDeleted');
            $this->emit('closeModal', $this);
            return to_route('list-posts');
        }
        // close this modal
        $this->emit('closeModal', $this);
    }
}
