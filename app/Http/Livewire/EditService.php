<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Closure;
use Filament\Forms;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class EditService extends ModalComponent implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Service $service;

    public string $title;

    public function render()
    {
        return view('livewire.edit-service');
    }

    public function mount(?int $service_id = null)
    {
        if (isset($service_id)) {
            $this->service = Service::find($service_id);
            $this->title = 'Edit Service';
            $this->form->fill([
                'heading' => $this->service->heading,
                'name' => $this->service->name,
                'slug' => $this->service->slug,
                'lottie_src' => $this->service->lottie_src,
                'summary' => $this->service->summary,
            ]);
        } else {
            $this->service = new Service;
            $this->title = 'New Service';
            $this->form->fill();
        }
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Grid::make([
                'default' => 1,
                'lg' => 2,
            ])
                ->schema([
                    Forms\Components\TextInput::make('heading')->default('We make'),
                    Forms\Components\TextInput::make('lottie_src')->url(),
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->autofocus()
                        ->reactive()
                        ->afterStateUpdated(function (Closure $set, $state) {
                            $set('slug', Str::slug($state));
                        }),
                    Forms\Components\TextInput::make('slug')->required(),
                    Forms\Components\Textarea::make('summary')
                        ->rows(4)
                    ->columnSpan(['lg' => 2]),
                ])
        ];
    }

    public function submit(): void
    {
        $this->service->fill($this->form->getState());
        $this->service->save();
        $this->closeModalWithEvents([
            ShowServices::getName() => 'refresh',
            ShowServicesSummary::getName() => 'refresh',
        ]);
    }
}
