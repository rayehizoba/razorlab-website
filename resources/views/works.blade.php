<x-layout>
    <!-- Header Section -->
    <header class="content relative">
        <aside class="pt-24 md:pt-0 md:absolute md:top-20 md:left-1/2 md:transform md:-translate-x-1/2">
            <div class="flex md:grid md:grid-cols-2 text-sm text-secondary-alt/75 invert">
                <section class="pr-20 text-secondary-alt/40">
                    Filter:
                </section>
                <section>
                    <ul class="space-y-1">
                        <template x-for="category in [
                        {
                            heading: 'We develop',
                            name: 'Websites',
                            lottie_src: 'https://assets10.lottiefiles.com/packages/lf20_4VvdIQ.json',
                        },
                        {
                            heading: 'We build',
                            name: 'Mobile Apps',
                            lottie_src: 'https://assets6.lottiefiles.com/packages/lf20_r6lfrga3.json',
                        },
                        {
                            heading: 'We make',
                            name: '3D Designs',
                            lottie_src: 'https://assets6.lottiefiles.com/packages/lf20_ihg7zmol.json',
                            lottie_classname: 'invert transform scale-[1.5]',
                        },
                        {
                            heading: 'We do',
                            name: '3D Printing',
                            lottie_src: 'https://assets6.lottiefiles.com/packages/lf20_vu2p4il8.json',
                        }
                    ]" hidden :key="category.name">
                            <li>
                                <a
                                    href="#"
                                    class="transition duration-500 md:cursor-none relative after:content-[''] after:left-0 after:bottom-0 after:absolute hover:after:w-full after:transition-all after:w-0 after:h-px after:bg-secondary-alt/75 after:duration-500"
                                >
                                    <span x-text="category.name"></span>
                                </a>
                            </li>
                        </template>
                    </ul>
                </section>
            </div>
        </aside>

        <div class="pt-20 md:pt-60 pb-16 md:pb-20">
            <h1 class="js-reveal-lines clip-text-gradient-c text-5xl md:text-7xl font-light tracking-tight w-fit">
                Work
            </h1>
        </div>
    </header>

    <!-- Case Studies: List -->
    <section class="content pb-32">
        <livewire:show-projects displaced/>
    </section>

    {{--  Scripts  --}}
    @push('scripts')
        <script>
        </script>
    @endpush
</x-layout>

