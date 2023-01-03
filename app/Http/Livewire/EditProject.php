<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Closure;
use Filament\Forms;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;
use FilamentEditorJs\Forms\Components\EditorJs;

class EditProject extends ModalComponent implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public function render()
    {
        return view('livewire.edit-project');
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public Project $project;

    public function mount(int $project_id)
    {
        $this->project = Project::find($project_id);
        $this->form->fill([
            'name' => $this->project->name,
            'slug' => $this->project->slug,
            'overview' => $this->project->overview,
            'client' => $this->project->client,
            'completed_at' => $this->project->completed_at,
            'caption' => $this->project->caption,
            'links' => $this->project->links,
            'published' => $this->project->published,
            'featured' => $this->project->featured,
            'thumbnail' => $this->project->thumbnail,
            'thumbnail_mask' => $this->project->thumbnail_mask,
            'content' => $this->project->content,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Tabs::make('Edit Project')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Overview')
                        ->schema([
                            Forms\Components\Grid::make([
                                'default' => 1,
                                'lg' => 3,
                            ])
                                ->schema([
                                    Forms\Components\Grid::make()
                                        ->schema([
                                            Forms\Components\FileUpload::make('caption')
                                                ->acceptedFileTypes([
                                                    'video/mp4',
                                                    'image/*'
                                                ])
                                                ->preserveFilenames()
                                                ->required()
                                                ->columnSpan(2),

                                            Forms\Components\Grid::make([
                                                'md' => 2,
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
                                                ]),

                                            Forms\Components\Textarea::make('overview')
                                                ->required()
                                                ->columnSpan(2),

                                            Forms\Components\Grid::make([
                                                'md' => 2,
                                            ])
                                                ->schema([
                                                    Forms\Components\TextInput::make('client'),

                                                    Forms\Components\DatePicker::make('completed_at'),
                                                ]),

                                            Forms\Components\Repeater::make('links')
                                                ->schema([
                                                    Forms\Components\TextInput::make('name')
                                                        ->default('Launch Project')
                                                        ->required(),

                                                    Forms\Components\TextInput::make('url')
                                                        ->required()
                                                        ->url(),
                                                ])
                                                ->columnSpan(2),
                                        ])
                                        ->columnSpan(['lg' => 2,]),
                                    Forms\Components\Grid::make(['default' => 1,])
                                        ->schema([
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

                                            Forms\Components\BelongsToManyMultiSelect::make('services')
                                                ->relationship('services', 'name'),

                                            Forms\Components\Toggle::make('published'),

                                            Forms\Components\Toggle::make('featured'),
                                        ])
                                        ->columnSpan(['lg' => 1,]),
                                ]),
                        ]),

                    Forms\Components\Tabs\Tab::make('Page Content')
                        ->schema([
                            EditorJs::make('content')
                        ]),
                ]),
        ];
    }

    protected function getFormModel(): Project
    {
        return $this->project;
    }

    public function submit(): void
    {
        $this->project->update($this->form->getState());
        $this->closeModalWithEvents([
            ShowProject::getName() => 'refresh',
        ]);
    }
}
