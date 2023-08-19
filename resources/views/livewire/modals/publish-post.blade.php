<div>
    <div>
        <h2 class="text-center text-2xl py-4">Confirm Action</h2>
        <p class="p-4 text-xl">This post: <span class="text-gray-600"> {{ $post ? $post->title : '' }}</span> is currently
            @if ($post->status)
                <span class="text-emerald-600 text-xl">Live</span>
            @else
            <span class="text-danger-600 text-xl">Not Live</span>
            @endif
        </p>
        <h2 class="text-center text-2xl py-4">Are you sure you want to
            @if ($post->status)
                <span class="text-danger-600 text-xl">draft</span>
            @else
                <span class="text-blue-600 text-xl">publish</span>
            @endif it ?
        </h2>

        <div class="mt-8 mx-4 mb-16 flex justify-center gap-4">
            <button onclick="Livewire.emit('closeModal', 'modals.publish-post')"
                class="py-2 px-2 rounded-md bg-gray-600 text-white font-semibold min-w-[100px]">No</button>
            <button wire:click="toggleStatus()"
                class="py-2 px-2 rounded-md bg-danger-700 text-white font-semibold min-w-[100px]">Yes</button>
        </div>
    </div>

</div>
