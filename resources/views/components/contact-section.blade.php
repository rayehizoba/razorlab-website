<div class="content bg-light text-secondary-alt md:min-h-screen">
    <div class="md:grid md:grid-cols-3 space-y-10 md:space-y-0 md:gap-20 pt-24 pb-10 md:pt-40">
        {{ $slot }}
        <div class="md:col-span-2 space-y-24">
            <ul class="grid md:grid-cols-2 gap-16 gap-y-5 md:gap-y-20">
                <template
                    x-for="each in [
                            { title: 'chat with\n us now', icon_classname: 'mdi-chat-outline', link:'https://wa.me/15714777777' },
                            { title: 'speak on\n the phone', icon_classname: 'mdi-phone-outline', link:'tel:+1 (571) 477-7777' },
                            { title: 'book a\n free consultation', icon_classname: 'mdi-calendar-blank', link:'mailto:info@razorlabs.tech' },
                            { title: 'send us\n an email', icon_classname: 'mdi-send-outline', link:'mailto:info@razorlabs.tech' },
                        ]"
                    :key="each.title" hidden>
                    <li class="relative group">
                        <a :href="each.link" class="md:cursor-none absolute inset-0 z-[1]"></a>
                        <article class="border-t border-light-alt py-5 space-y-2">
                            <div class="js-reveal-el">
                                <i class="mdi text-3xl" :class="each.icon_classname"></i>
                            </div>
                            <div class="flex items-end justify-between">
                                <div class="capitalize js-reveal-lines font-light text-xl leading-relaxed group-hover:tracking-wide transition-all duration-500"
                                    x-html="each.title.replace('\n', '<br/>')">
                                </div>
                                <i class="js-reveal-el mdi mdi-arrow-top-right text-lg" data-reveal-delay="0.2"></i>
                            </div>
                        </article>
                    </li>
                </template>
            </ul>

            <div class="max-w-sm grid grid-cols-2 gap-16">

                <div class="text-sm">
                    <p class="mb-3 font-brand">
                        Follow us
                    </p>
                    <ul class="text-secondary-alt/50 space-y-2">
                        <template
                            x-for="each in [
                            {title:'Youtube', link:'youtube'},
                            {title:'linkedIn', link:'linkedin'}
                            ]"
                            :key="each.title" hidden>
                            <li>
                                <a :href="each.link"
                                    class="md:cursor-none relative after:content-[''] after:left-0 after:bottom-0 after:absolute hover:after:w-full after:transition-all after:w-0 after:h-px after:bg-secondary-alt/50 after:duration-500 before:content-[''] before:left-0 before:bottom-0 before:absolute before:w-full before:h-px before:bg-light-alt">
                                    <span x-html="each.title"></span>
                                </a>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
