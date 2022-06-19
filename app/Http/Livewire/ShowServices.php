<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ShowServices extends Component
{
    public Collection $services;

    protected $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        $this->services = Service::all();
        return view('livewire.show-services');
    }
}
