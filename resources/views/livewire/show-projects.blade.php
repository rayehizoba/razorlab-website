<ul class="{{ $className ? $className : 'grid md:grid-cols-2 lg:grid-cols-3 gap-16 gap-y-28' }}">
    @auth
        @if($limit == 0)
            <li>
                <div
                    onclick="Livewire.emit('openModal', 'start-project')"
                    class="w-full aspect-[2/1] border-dotted border-2 border-secondary-alt hover:border-white/50 transition duration-500 rounded grid place-content-center text-secondary-alt hover:text-white/50"
                >
                    <div class="flex flex-col items-center">
                        <i class="mdi mdi-plus text-7xl"></i>
                        <p class="text-xs">New Work</p>
                    </div>
                </div>
            </li>
        @endif
    @endauth
    @foreach($projects as $project)
        <li>
            <x-work-card :project="$project" :displaced="$displaced"/>
        </li>
    @endforeach
</ul>
