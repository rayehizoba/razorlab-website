<x-layout>
    <!-- Header Section -->
    <header class="content border-b border-secondary-alt relative w-screen overflow-hidden">
        <div class="md:min-h-screen flex flex-col md:flex-row md:divide-x divide-secondary-alt">
            <div class="w-full md:w-1/2 flex flex-col justify-center relative pt-32 pb-14 md:py-40">
                <h1 class="js-reveal-lines text-4xl md:text-6xl font-light md:max-w-md !leading-tight tracking-tight">
                    We help brands <br>
                </h1>
                <h1 class="clip-text-gradient-a js-reveal-lines text-4xl md:text-6xl font-light md:max-w-md !leading-tight tracking-tight w-fit">
                    that do good <br>
                    look good.
                </h1>
                <p class="js-reveal-lines w-3/4 md:w-auto font-brand text-secondary-alt font-light tracking-wider md:max-w-xs md:absolute bottom-0 mt-10 md:my-16">
                    Leading digital agency with solid design and development
                    expertise.
                </p>
            </div>
            <div class="w-full md:w-1/2">
                <livewire:show-services/>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section class="content border-b border-secondary-alt">
        <div class="flex flex-col md:flex-row pb-20 md:py-32">
            <div class="w-full md:w-1/2">
                <lottie-player
                    id="servicesLottie"
                    src="https://assets2.lottiefiles.com/packages/lf20_kgotdjba.json"
                    background="transparent"
                    speed="1"
                    loop
                    autoplay
                ></lottie-player>
                @push('scripts')
                    <script>
                        LottieInteractivity.create({
                            player:'#servicesLottie',
                            mode:"scroll",
                            actions: [
                                {
                                    visibility: [0.0, 1.0],
                                    type: "play"
                                }
                            ]
                        });
                    </script>
                @endpush
            </div>
            <div class="w-full md:w-1/2 flex items-center">
                <div class="max-w-lg mx-auto space-y-10 text-center md:text-left">
                    <p class="js-reveal-lines text-2xl md:text-3xl font-light !leading-normal clip-text-gradient-b text-center md:text-left">
                        We build readymade websites, mobile applications
                        and 3D products for elaborate online business services.
                    </p>
                    <a
                        href="{{ route('services') }}"
                        data-magic-button
                        class="md:cursor-none js-reveal-el relative inline-block group"
                    >
                        <div data-magic-button-area class="magnetic-size z-[1] absolute -inset-2 -inset-y-5"></div>
                        <div data-magic-button-content class="">
                            <div
                                class="border border-white rounded-full p-3 px-5 text-sm group-hover:text-black group-hover:bg-white transition font-extralight">
                                Our Services <i class="mdi mdi-arrow-right-circle-outline ml-1"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Case Studies: Heading -->
    <section class="content">
        <p class="py-20 md:py-32 text-4xl md:text-6xl font-light">
            <span class="js-reveal-lines">Featured <br></span>
            <span class="text-stroke invert js-reveal-lines">Case Studies</span>
        </p>
    </section>

    <!-- Featured Case Studies: List -->
    <section class="content">
        <livewire:show-projects featured displaced/>
    </section>

    <!-- Discover All Projects -->
    <section class="content">
        <div class="py-20 text-center">
            <a
                href="{{ route('works') }}"
                data-magic-button
                class="js-reveal-el md:cursor-none relative inline-block group"
            >
                <div data-magic-button-area class="magnetic-size z-[1] absolute -inset-2 -inset-y-5"></div>
                <div data-magic-button-content class="">
                    <div
                        class="border border-white rounded-full p-3 px-5 text-sm group-hover:text-black group-hover:bg-white transition font-extralight">
                        Discover All Projects <i class="mdi mdi-arrow-right-circle-outline ml-1"></i>
                    </div>
                </div>
            </a>
        </div>
    </section>
</x-layout>

