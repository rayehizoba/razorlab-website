<?php

namespace App\Http\Livewire;

use Filament\Forms;
use LivewireUI\Modal\ModalComponent;

class StartTutorial extends ModalComponent implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public function render()
    {
        return view('livewire.start-tutorial');
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\FileUpload::make('caption')
                ->image()
                ->preserveFilenames()
                ->required(),
            Forms\Components\MultiSelect::make('categories')
                ->options([
                    'tailwind' => 'TailwindCSS',
                    'alpine' => 'Alpine.js',
                    'laravel' => 'Laravel',
                    'livewire' => 'Laravel Livewire',
                ]),
        ];
    }

    public function submit(): void
    {
        // ...
    }
}
