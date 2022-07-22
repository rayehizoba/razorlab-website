<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class ShowProject extends Component
{
    public Project $project;

    public function mount($slug)
    {
        $this->project = Project::whereSlug($slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.show-project');
    }

    protected $listeners = ['refresh' => '$refresh'];

    public function delete()
    {
        $this->project->delete();
        return redirect()->route('works');
    }
}
