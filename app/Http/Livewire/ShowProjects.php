<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ShowProjects extends Component
{
    public Collection $projects;
    public int $featured;
    public int $limit;
    public int $displaced;
    public string $className;

    public function render()
    {
        $query = Project::query();

        if ($this->featured) {
            $query = $query->featured();
        }

        if ($this->limit > 0) {
            $query = $query->limit($this->limit);
        }

        $this->projects = $query->latest()->get();

        return view('livewire.show-projects');
    }

    protected $listeners = ['refresh' => '$refresh'];

    public function mount(bool $featured = false, int $limit = 0, bool $displaced = false, string $className = '')
    {
        $this->featured = $featured;
        $this->limit = $limit;
        $this->displaced = $displaced;
        $this->className = $className;
    }
}
