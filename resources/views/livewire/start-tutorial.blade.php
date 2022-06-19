<div class="container py-5 text-black">
    <form wire:submit.prevent="submit" class="space-y-5">
        <p class="text-2xl">
            Start a Tutorial
        </p>

        {{ $this->form }}

        <div class="grid grid-cols-2 gap-5">
            <button class="btn border" type="button">
                Cancel
            </button>
            <button class="btn bg-black text-white" type="submit">
                Submit
            </button>
        </div>
    </form>
</div>
