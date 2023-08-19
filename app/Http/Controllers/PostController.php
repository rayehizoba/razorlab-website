<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //return the add post page
    public function createPost()
    {
        return view('posts.add-post');
    }
    //return the edit post page
    public function editPost($id)
    {
        $post = Post::where('id', $id)->first();
        return view('posts.edit-post')->with('post', $post);
    }
    //return the list post page
    public function listPosts()
    {
        return view('posts.list-posts');
    }

    public function blog(){
        $posts = Post::with(['category'])->get();

        return view('blog')->with('posts', $posts);
    }

    public function showPost($slug){
        $post = Post::where('slug', $slug)->with('author', 'category')->first();
        return view('post')->with('post', $post);
    }
}
