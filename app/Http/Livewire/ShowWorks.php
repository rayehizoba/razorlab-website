<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class ShowWorks extends Component
{
    public $filter;

    protected $queryString = ['filter'];

    public function render()
    {
        $this->services = Service::all();
        return view('livewire.show-works');
    }

    public function setFilter($service_id)
    {
        $this->filter = $service_id;
    }
}
