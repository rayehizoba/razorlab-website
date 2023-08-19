<?php

namespace App\Http\Livewire\Modals;

use App\Models\Post;
use LivewireUI\Modal\ModalComponent;

class PublishPost extends ModalComponent
{
    public $postId;

    public function render()
    {
        $post = Post::where('id', '=', $this->postId)->first();
        return view('livewire.modals.publish-post')->with('post', $post);
    }

    public function toggleStatus(){
        $post = Post::where('id', '=', $this->postId)->first();
        if ($post) {
            $post->update([
                'status' => $post->status === true ? false : true,
            ]);
            $this->emit('closeModal', $this);
            return to_route('list-posts');
        }
    }
}
