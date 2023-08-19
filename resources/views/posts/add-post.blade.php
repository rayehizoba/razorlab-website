<x-app-layout>
    <style>
        .ck-editor__editable[role="textbox"] {
            min-height: 200px;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Post') }}
        </h2>
    </x-slot>

    @livewire('blog.create-post')

<script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
<script>
    /* ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } ); */
</script>
</x-app-layout>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> --}}


