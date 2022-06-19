<article>
    <!-- Header Section -->
    <header class="content bg-light text-secondary relative">
        <aside class="pt-24 md:pt-0 md:absolute md:top-20 md:left-1/2 md:transform md:-translate-x-1/2">
            <div class="flex md:grid md:grid-cols-2 text-sm font-medium text-secondary-alt">
                <section class="pr-20 text-secondary-alt/50">
                    Jump to:
                </section>
                <section>
                    <ul class="space-y-1 capitalize">
                        @foreach($services as $service)
                            <li>
                                <a
                                    href="{{ route('services').'#'.$service->slug }}"
                                    class="transition duration-500 md:cursor-none relative after:content-[''] after:left-0 after:bottom-0 after:absolute hover:after:w-full after:transition-all after:w-0 after:h-px after:bg-secondary-alt/50 after:duration-500"
                                >
                                    {{ $service->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>
        </aside>

        <div class="pt-20 md:pt-80 pb-16 md:pb-20 space-y-5 md:space-y-20">
            <h1 class="clip-text-gradient-c js-reveal-lines text-5xl md:text-9xl tracking-tighter w-fit">
                What we do
            </h1>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="md:col-span-2 md:col-start-2">
                    <div class="max-w-2xl space-y-10">
                        <p data-reveal-delay="0.2"
                           class="js-reveal-lines text-xl md:text-3xl leading-snug font-light">
                            We build better businesses by creating joyful digital ideas, products and experiences
                            that connect the
                            hearts of brands to the hearts of their consumers.
                        </p>
                        <a
                            data-magic-button
                            data-reveal-delay="0.5"
                            class="js-reveal-el md:cursor-none relative inline-block group"
                            href="{{ route('works') }}"
                        >
                            <div data-magic-button-area
                                 class="magnetic-size z-[1] absolute -inset-2 -inset-y-5"></div>
                            <div data-magic-button-content class="">
                                <div
                                    class="border border-black rounded-full p-3 px-5 text-sm group-hover:text-white group-hover:bg-black transition font-extralight">
                                    Discover All Projects <i class="mdi mdi-arrow-right-circle-outline ml-1"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{--  Services Overview Section  --}}
    @foreach($services as $service)
        <section id="{{ $service->slug }}" class="content bg-white text-secondary">
            <div class="{{ $loop->last ? 'pb-16' : 'pb-4' }} grid md:grid-cols-3 gap-10 pt-16 md:py-24">
                <div class="hidden md:block">
                    @isset($service->lottie_src)
                        <lottie-player
                            src="{{$service->lottie_src}}"
                            background="transparent"
                            speed="1"
                            loop
                            autoplay
                            style="height: 30ch;"
                            {{--                                :class="category.lottie_classname"--}}
                        ></lottie-player>
                    @endisset
                </div>
                <div class="col-span-2 relative">
                    <p class="text-xs text-secondary/50">
                        {{ $service->heading ?? 'We make' }}
                    </p>

                    <div class="mt-8 md:mt-2 mb-4 md:mb-16">
                        <h2 class="text-5xl md:text-7xl tracking-tighter">
                            {{ $service->name }}
                        </h2>

                        @auth
                            <div class="flex items-center space-x-4">
                                <div
                                    onclick="Livewire.emit('openModal', 'edit-service', {{ json_encode(["service_id" => $service->id]) }})"
                                    title="Edit {{ $service->name }}"
                                    class="text-2xl aspect-square w-14 grid place-content-center hover:bg-light rounded-full transition"
                                >
                                    <i class="mdi mdi-pencil-outline"></i>
                                </div>
                                <div
                                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                    wire:click="delete({{ $service->id }})"
                                    wire:target="delete({{ $service->id }})"
                                    wire:loading.class="opacity-50"
                                    title="Remove {{ $service->name }}"
                                    class="text-2xl aspect-square w-14 grid place-content-center hover:bg-light rounded-full transition hover:text-red-600"
                                >
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </div>
                            </div>
                        @endauth
                    </div>

                    <article class="md:text-lg font-light leading-relaxed mb-8">
                        <p>
                            {!! str_replace("\n", "<br/>", $service->summary) !!}
                        </p>
                    </article>

                    <a
                        data-magic-button
                        class="md:cursor-none relative inline-block group"
                        href="{{ route('works', ['filter' => $service->slug]) }}"
                    >
                        <div data-magic-button-area
                             class="magnetic-size z-[1] absolute -inset-2 -inset-y-5"></div>
                        <div data-magic-button-content class="">
                            <div
                                class="border border-black rounded-full p-3 px-5 text-sm group-hover:text-white group-hover:bg-black transition font-extralight capitalize">
                                {{ 'View '.$service->name }}
                                <i class="mdi mdi-arrow-right-circle-outline ml-1"></i>
                            </div>
                        </div>
                    </a>

                    <livewire:show-projects
                        :key="$service->id"
                        className="grid md:grid-cols-2 gap-8 mt-8 md:mt-24"
                        limit="2"
                    />
                </div>
            </div>
        </section>
    @endforeach

    @auth
        {{--  New Service Button  --}}
        <section class="content bg-white text-secondary">
            <div class="py-16 grid md:grid-cols-3 gap-10 md:py-24">
                <div class="col-span-2 col-start-2">
                    <div class="mt-8 md:mt-2 mb-4 md:mb-16">
                        <div
                            wire:ignore
                            data-magic-button
                            onclick="Livewire.emit('openModal', 'edit-service')"
                            class="relative inline-block group"
                        >
                            <div data-magic-button-area class="magnetic-size z-[1] absolute -inset-2 -inset-y-5">
                            </div>
                            <div data-magic-button-content class="">
                                <div
                                    class="group-hover:text-secondary-alt transition-all duration-500 text-5xl md:text-7xl tracking-tighter flex space-x-1">
                                    <h2>New Service</h2>
                                    <i class="mdi mdi-plus-circle-outline"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endauth
</article>
