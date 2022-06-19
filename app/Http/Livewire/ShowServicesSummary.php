<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ShowServicesSummary extends Component
{
    protected $listeners = ['refresh' => '$refresh'];

    public Collection $services;

    public function render()
    {
        $this->services = Service::all();
        return view('livewire.show-services-summary');
    }

    public function delete(int $service_id)
    {
        Service::destroy($service_id);
    }
}
