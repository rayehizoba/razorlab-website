<?php

namespace App\Http\Livewire\Blog;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Component;

class CreatePost extends Component
{
    public $title;
    public $content;
    public $category;
    public $photo;
    public $errorMessage;
    public $successMessage;


    use WithFileUploads;

    public function render()
    {
        $categories = Category::get();
        return view('livewire.blog.create-post')->with('categories', $categories);
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

            $post = new Post([
                'title' => $this->title,
                'content' => $this->content,
                'slug' => $slug,
                'category_id' => $this->category,
                'user_id' => Auth::id(),
            ]);

            if ($this->photo) {
                $path = $this->photo->store('posts');
                $post->cover_image = $path;
            }

            $post->save();
            $this->successMessage = "Post successfully Created.!!";
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
//'photo' => $request->file('photo') ? $request->file('photo')->store('path_to_store_image') : null,
