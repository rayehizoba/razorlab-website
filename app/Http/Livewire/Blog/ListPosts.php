<?php

namespace App\Http\Livewire\Blog;

use App\Models\Post;
use Livewire\Component;

class ListPosts extends Component
{

    public function render()
    {
        $posts = Post::get();
        return view('livewire.blog.list-posts')->with('posts', $posts);
    }

    public function confirmDelete($postId)
{
    $this->emit('openModal', 'modals.delete-post', ['postId' => $postId]);
}
}
