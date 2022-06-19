<?php

namespace App\Http\Livewire;

use Filament\Forms;
use LivewireUI\Modal\ModalComponent;

class EditReview extends ModalComponent implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public function render()
    {
        return view('livewire.edit-review');
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\FileUpload::make('photo')
                ->image()
                ->preserveFilenames()
                ->required(),
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Textarea::make('review')
                ->rows(4)
                ->required(),
        ];
    }

    public function submit(): void
    {
        // ...
    }
}
