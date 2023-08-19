<?php

namespace App\Http\Livewire\Blog;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Component;

class EditPost extends Component
{
    public $title;
    public $content;
    public $category;
    public $photo;
    public $errorMessage;
    public $successMessage;
    public $post_id;


    use WithFileUploads;

    public function mount($post)
    {
        $this->post_id = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->category = $post->category_id;
        $this->photo = $post->photo;
    }
    public function render()
    {
        $categories = Category::get();
        return view('livewire.blog.edit-post')->with('categories', $categories);
    }

    protected $rules = [
        'title' => 'required|string|max:75',
        'content' => 'required|string|min:50',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'category' => "required",
    ];

    public function updated($postTitle)
    {
        $this->validateOnly($postTitle, $this->rules);
    }

    public function save()
    {
        try {
            $this->validate($this->rules);

            $slug = Str::slug($this->title, '-') . now()->format('Ymd-His');
            $post  = Post::where('id', $this->post_id)->first();
            $post->title = $this->title;
            $post->content = $this->content;
            $post->category_id = $this->category;

            if ($this->photo) {
                $path = $this->photo->store('posts');
                $post->cover_image = $path;
            }

            $post->save();
            $this->successMessage = "Post successfully Updated.";
            $this->emit('showMessage');
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
            $this->emit('showMessage');
        }
    }

    public function clearMessage()
    {
        $this->successMessage = '';
        $this->errorMessage = '';
    }
}
