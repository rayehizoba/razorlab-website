<div>
    <!-- Header Section -->
    <header class="content relative">
        <aside class="pt-24 md:pt-0 md:absolute md:top-20 md:left-1/2 md:transform md:-translate-x-1/2">
            <div class="flex md:grid md:grid-cols-2 text-sm text-secondary-alt/75 invert">
                <section class="pr-20 text-secondary-alt/40">
                    Filter:
                </section>
                <section>
                    <ul class="space-y-1">
                        @foreach($services as $service)
                            <li>
                                <a
                                    wire:click.prevent="setFilter({{$service->id}})"
                                    class="@if($filter == $service->id) after:w-full @endif transition duration-500 md:cursor-none relative after:content-[''] after:left-0 after:bottom-0 after:absolute hover:after:w-full after:transition-all after:w-0 after:h-px after:bg-secondary-alt/75 after:duration-500"
                                >
                                    <span>{{$service->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>
        </aside>

        <div class="pt-20 md:pt-60 pb-16 md:pb-20">
            <h1 wire:ignore class="js-reveal-lines clip-text-gradient-c text-5xl md:text-7xl font-light tracking-tight w-fit">
                Work
            </h1>
        </div>
    </header>

    <!-- Case Studies: List -->
    <section class="content pb-32">
        <livewire:show-projects :key="$filter" displaced :serviceId="$filter"/>
    </section>
</div>
