<ul class="border-t md:border-none border-secondary-alt grid grid-cols-1 inset-y-0 -mx-6 md:mx-0 h-full">
    @foreach($services as $service)
        <li class="relative">
            @if(auth()->check() || !$loop->last)
                <div class="h-px bg-secondary-alt w-screen absolute left-0 bottom-0"></div>
            @endif
            <a
                href="{{ route('services').'#'.$service->slug }}"
                class="md:cursor-none h-full p-6 md:p-10 flex group w-screen"
            >
                <div
                    class="w-full md:w-[32ch] lg:w-[40ch] xl:w-[50ch] flex items-center justify-between">
                    <div
                        class="text-2xl md:text-4xl font-extralight relative overflow-hidden !leading-normal capitalize">
                        <div
                            class="js-reveal-lines after:content-['View'] after:absolute after:left-0 after:top-full transition-all ease-in-out duration-700 group-hover:-translate-y-full transform"
                            data-reveal-delay="0.2"
                        >
                            {{ $service->name }}
                        </div>
                    </div>
                    <i
                        class="js-reveal-el mdi mdi-arrow-top-right text-xl md:text-2xl"
                        data-reveal-delay="0.4"
                    ></i>
                </div>
            </a>
        </li>
    @endforeach
    @auth
        <li class="">
            <div
                onclick="Livewire.emit('openModal', 'edit-service')"
                class="h-full w-screen p-6 md:p-10 flex group hover:bg-secondary-alt transition duration-500 text-light/30 hover:text-white"
            >
                <div class="w-full md:w-[32ch] lg:w-[40ch] xl:w-[50ch] flex items-center justify-between">
                    <div
                        class="js-reveal-lines text-2xl md:text-4xl font-extralight relative overflow-hidden !leading-normal"
                        data-reveal-delay="0.2"
                    >
                        New Service
                    </div>
                    <i class="js-reveal-el mdi mdi-plus-circle-outline text-xl md:text-2xl"
                       data-reveal-delay="0.4"></i>
                </div>
            </div>
        </li>
    @endauth
</ul>
