<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg md:px-4">
            <h2 class="w-full text-3xl font-semibold text-center">Create a new post</h2>
            <form class="p-8" wire:submit.prevent="save">
                @csrf
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model="title" />
                    <x-jet-input-error for="title" class="mt-2" />
                </div>

                <div class="mt-8 col-span-6 sm:col-span-4" wire:ignore>
                    <x-jet-label for="content" value="{{ __('Content') }}" />
                    <textarea wire:model="content" class="min-h-fit h-48" name="content" id="content"></textarea>
                </div>
                <x-jet-input-error for="content" class="mt-2" />

                <div x-data="{ photoName: null, photoPreview: null }" class="mt-8 col-span-6 sm:col-span-4">
                    <input type="file" class="hidden" wire:model="photo" x-ref="photo"
                        x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                " />

                    <x-jet-label for="photo" value="{{ __('Cover Image') }}" />
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block rounded-md w-64 h-24 bg-cover bg-no-repeat bg-center"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-jet-secondary-button>

                    <x-jet-input-error for="photo" class="mt-2" />
                    {{$photo}}
                </div>

                <div class="mt-8 col-span-6 sm:col-span-4">
                    <select wire:model="category" class="w-48 rounded-sm min-h-[35px]">
                        <option value="">---select category---</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full text-center block">
                    @if ($errorMessage)
                        <div class="mt-8 mb-4 text-danger-600">
                            {{ $errorMessage }}
                        </div>
                    @endif
                    @if ($successMessage)
                        <div class="mt-8 mb-4 text-emerald-600">
                            {{ $successMessage }}
                        </div>
                    @endif
                    <x-jet-button class="align-middle">
                        {{ __('Save') }}
                    </x-jet-button>
                </div>


            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            ClassicEditor
                .create(document.querySelector('#content'))
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.set('content', editor.getData());
                    })
                })
                .catch(error => {
                    console.error(error);
                });
        });



        document.addEventListener('livewire:update', function() {
            Livewire.on('showMessage', function() {
                setTimeout(function() {
                    @this.call('clearMessage');
                }, 5000);
            });
        });
    </script>
@endpush
