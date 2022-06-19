<div class="container py-5 text-black">
    <form wire:submit.prevent="submit" class="space-y-5">
        <p class="text-2xl">
            Start a Project
        </p>

        {{ $this->form }}

        <div class="grid grid-cols-2 gap-5 max-w-xs">
            <button class="btn bg-black text-white" type="submit">
                Submit
            </button>
            <button wire:click="$emit('closeModal')" class="btn border bg-white" type="button">
                Cancel
            </button>
        </div>
    </form>
</div>
