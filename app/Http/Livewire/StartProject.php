<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Closure;
use Filament\Forms;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class StartProject extends ModalComponent implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public function render()
    {
        return view('livewire.start-project');
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function mount()
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Grid::make([
                'default' => 1,
                'lg' => 2,
            ])
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->autofocus()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function (Closure $set, $state) {
                            $set('slug', Str::slug($state));
                        }),
                    Forms\Components\TextInput::make('slug')->required(),
                    Forms\Components\FileUpload::make('thumbnail')
                        ->acceptedFileTypes([
                            'video/mp4',
                            'image/*'
                        ])
                        ->preserveFilenames()
                        ->required(),
                    Forms\Components\FileUpload::make('thumbnail_mask')
                        ->acceptedFileTypes([
                            'video/mp4',
                            'image/*'
                        ])
                        ->preserveFilenames(),
                    Forms\Components\MultiSelect::make('services')
                        ->relationship('services', 'name'),
                    Forms\Components\Toggle::make('featured')
                        ->default(1)
                        ->columnSpan(['lg' => 2]),
                ])
        ];
    }

    protected function getFormModel(): string
    {
        return Project::class;
    }

    public function submit(): void
    {
        Project::create($this->form->getState());
        $this->closeModalWithEvents([
            ShowProjects::getName() => 'refresh',
        ]);
    }
}
