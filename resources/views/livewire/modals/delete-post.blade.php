<div>
    <h2 class="text-center text-2xl py-4">Are you sure you want to delete this post?</h2>
    <p class="p-4">Title: {{ $post ? $post->title : '' }}</p>
    <div class="mt-8 mx-4 mb-16 flex justify-center gap-4">
        <button onclick="Livewire.emit('closeModal', 'modals.delete-post')"
            class="py-2 px-2 rounded-md bg-gray-600 text-white font-semibold min-w-[100px]">Cancel</button>
        <button wire:click="confirmDeletePost()"
            class="py-2 px-2 rounded-md bg-danger-700 text-white font-semibold min-w-[100px]">Confirm</button>
    </div>
</div>
