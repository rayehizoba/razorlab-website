<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#000000">
    <link rel="icon" href="{{ asset('/favicon.png') }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel=stylesheet href="//cdn.jsdelivr.net/npm/@mdi/font@6.1.95/css/materialdesignicons.min.css">

    <!-- Styles -->
    @livewireStyles
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="{{ asset('vendor/filament-editorjs/css/editor.css') }}" rel="stylesheet">
</head>
<body
    x-cloak
    x-data="Main"
    class="bg-secondary text-light transition opacity-0 overflow-x-hidden antialiased md:cursor-none"
>

<!-- Main Navigation -->
<nav class="content fixed top-10 md:top-20 inset-x-0 mix-blend-difference invert z-20">
    <div class="flex items-center justify-between h-0">
        <a
            href="{{ route('home') }}"
            class="font-brand text-secondary flex md:cursor-none text-xl md:text-2xl tracking-tight"
        >
            <span class="js-reveal-lines" data-reveal-delay="0.6">razor</span>
            <span class="js-reveal-lines text-stroke text-transparent" data-reveal-delay="0.6">labs</span>
        </a>
        <button
            data-magic-cursor-area
            @click="menu = !menu"
            class="md:cursor-none text-3xl md:text-4xl text-black uppercase -mr-4 w-14 md:w-16 aspect-square grid place-content-center"
        >
            <lottie-player
                id="toggleLottie"
                data-magic-cursor-target
                src="https://assets5.lottiefiles.com/packages/lf20_ycx5i3d6.json"
                class="transform scale-75"
            >
            </lottie-player>
        </button>
    </div>
</nav>

<!-- Main Menu -->
<nav
    :class="menu ? 'max-h-screen':'max-h-0 pointer-events-none'"
    class="js-menu fixed inset-0 z-10 bg-light transition-all duration-700 ease-in-out overflow-hidden"
>
    <div class="overflow-auto h-full" :class="{'scrollbar-none': !menu}">
        <x-contact-section>
            <ul class="text-4xl md:text-5xl lg:text-7xl !leading-tight font-light tracking-tight flex flex-col">
                <li>
                    <a
                        href="{{ route('works') }}"
                        class="{{ Route::currentRouteNamed(['works', 'work']) ? 'text-stroke text-transparent':'' }} js-reveal-lines md:cursor-none hover:tracking-normal transition-all duration-300"
                    >
                        Work
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('services') }}"
                        class="{{ Route::currentRouteNamed('services') ? 'text-stroke text-transparent':'' }} js-reveal-lines md:cursor-none hover:tracking-normal transition-all duration-300"
                    >
                        Services
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('about') }}"
                        class="{{ Route::currentRouteNamed('about') ? 'text-stroke text-transparent':'' }} js-reveal-lines md:cursor-none hover:tracking-normal transition-all duration-300"
                    >
                        About
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('blog') }}"
                        class="{{ Route::currentRouteNamed(['blog', 'post']) ? 'text-stroke text-transparent':'' }} js-reveal-lines md:cursor-none hover:tracking-normal transition-all duration-300"
                    >
                        Blog
                    </a>
                </li>
            </ul>
        </x-contact-section>
    </div>
</nav>

{{ $slot }}

<!-- Contact Us Section -->
<x-contact-section>
    <h1 class="text-4xl md:text-5xl font-light md:max-w-lg !leading-tight w-fit pb-10">
        <span class="js-reveal-lines">Let's chat, <br></span>
        <span class="js-reveal-lines clip-text-gradient-c">we respond quickly</span>
    </h1>
</x-contact-section>

<!-- Magic Cursor -->
<div
    data-magic-cursor
    class="w-0 h-0 rounded-full mix-blend-difference invert border border-black bg-black fixed top-[100%] left-[100%] transform transform-gpu transition -translate-y-1/2 -translate-x-1/2 pointer-events-none z-20"
></div>

<!-- Scripts -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-interactivity@latest/dist/lottie-interactivity.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/split-type@0.2.5/umd/index.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"
        integrity="sha512-VEBjfxWUOyzl0bAwh4gdLEaQyDYPvLrZql3pw1ifgb6fhEvZl9iDDehwHZ+dsMzA0Jfww8Xt7COSZuJ/slxc4Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/ScrollTrigger.min.js"></script>
<!-- Lottie Menu Interactivity -->
<script>
    LottieInteractivity.create({
        player: '#toggleLottie',
        mode: "cursor",
        actions: [
            {
                type: "toggle"
            }
        ]
    });
</script>
@livewireScripts
<script src="{{ mix('js/app.js') }}" defer></script>
<script src="{{ asset('vendor/filament-editorjs/js/editor.js') }}"></script>
@stack('scripts')

{{-- Modals --}}
@livewire('livewire-ui-modal')

</body>
</html>
