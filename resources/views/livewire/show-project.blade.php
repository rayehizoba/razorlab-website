<main x-data="page">
    {{--  Caption Media Section  --}}
    @isset($project->caption)
        <header class="w-full aspect-[4/5] sm:aspect-square md:aspect-[2/1] bg-center bg-cover relative bg-light">
            @switch(\Storage::disk('public')->mimeType($project->caption))
                @case('video/mp4')
                <video x-ref="caption" preload="none" autoplay playsinline loop muted
                       class="w-full h-full object-cover">
                    <source src="{{ $project->caption_url }}" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
                @break

                @default
                <img
                    x-ref="caption"
                    src="{{ $project->caption_url }}"
                    alt="{{ $project->name }}"
                    class="w-full h-full object-cover"
                >
                @break
            @endswitch
        </header>
    @else
        <div class="w-full h-14 md:h-24"></div>
    @endisset

    {{-- Project Overview Section --}}
    <article
        :class="color.isDark ? 'text-light':'text-secondary'"
        :style="{backgroundColor: color.rgba}"
        class="content py-10 md:pb-20 space-y-10"
    >
        @auth
            {{-- Edit/Delete Project --}}
            <div class="flex space-x-10">
                <div
                    data-magic-button
                    onclick="Livewire.emit('openModal', 'edit-project', {{ json_encode(["project_id" => $project->id]) }})"
                    class="relative inline-block group w-full md:w-fit"
                >
                    <div data-magic-button-area class="magnetic-size z-[1] absolute -inset-2 -inset-y-5"></div>
                    <div data-magic-button-content class="">
                        <div
                            :class="(color && color.isDark) ? 'border-white group-hover:text-black group-hover:bg-white' : 'border-black text-black group-hover:text-white group-hover:bg-black'"
                            class="border rounded-full p-3 px-5 text-sm transition font-light text-center"
                        >
                            Edit Project <i class="mdi mdi-pencil-outline ml-1"></i>
                        </div>
                    </div>
                </div>

                <div
                    data-magic-button
                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                    wire:click="delete"
                    wire:target="delete"
                    wire:loading.class="opacity-50"
                    class="relative inline-block group w-full md:w-fit"
                >
                    <div data-magic-button-area class="magnetic-size z-[1] absolute -inset-2 -inset-y-5"></div>
                    <div data-magic-button-content class="">
                        <div
                            :class="(color && color.isDark) ? 'border-white group-hover:border-red-600 group-hover:text-white group-hover:bg-red-600' : 'border-black group-hover:border-red-600 text-black group-hover:text-white group-hover:bg-red-600'"
                            class="border rounded-full p-3 px-5 text-sm transition font-light text-center"
                        >
                            Delete Project <i class="mdi mdi-archive-arrow-down-outline ml-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endauth

        {{-- Project Name --}}
        <h1 class="text-4xl js-reveal-lines leading-tight">
            {{ $project->name }}
        </h1>

        {{-- Project Overview --}}
        <div class="grid gap-8 md:gap-12 md:grid-cols-3">
            <div class="space-y-10">
                <div class="grid grid-cols-2 gap-5 text-sm">
                    @isset($project->client)
                        <p class="">
                            <span
                                :class="color.isDark ? 'mix-blend-screen':'mix-blend-difference'"
                                class="invert text-secondary-alt/60 drop-shadow-sm">Client:</span> {{ $project->client }}
                        </p>
                    @endisset
                    @isset($project->completed_at)
                        <p class="">
                            <span
                                :class="color.isDark ? 'mix-blend-screen':'mix-blend-difference'"
                                class="invert text-secondary-alt/60 drop-shadow-sm">Date:</span> {{ date('M Y', strtotime($project->completed_at)) }}
                        </p>
                    @endisset
                    @if($project->services->count() > 0)
                        <p class="col-span-2">
                            <span
                                :class="color.isDark ? 'mix-blend-screen':'mix-blend-difference'"
                                class="invert text-secondary-alt/60 drop-shadow-sm">Deliverables:</span>
                            {{ $project->services->pluck('name')->map(fn($name) => \Str::singular($name))->implode(', ') }}
                        </p>
                    @endif
                </div>
                <div class="flex space-x-7 items-center">
                    @foreach($project->links ?? [] as $link)
                        <a
                            data-magic-button
                            class="relative inline-block group w-full md:w-fit md:cursor-none"
                            href="{{ $link['url'] }}"
                            target="_blank"
                        >
                            <div data-magic-button-area class="magnetic-size z-[1] absolute -inset-2 -inset-y-5"></div>
                            <div data-magic-button-content class="">
                                <div
                                    :class="(color && color.isDark) ? 'border-white group-hover:text-black group-hover:bg-white' : 'border-black group-hover:text-white group-hover:bg-black'"
                                    class="border rounded-full p-3 px-5 text-sm transition font-light text-center"
                                >
                                    {{ $link['name'] }} <i class="mdi mdi-arrow-top-right"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="md:col-span-2 space-y-8">
                <p class="text-lg leading-relaxed font-light">
                    {!! str_replace("\n", "<br/>", $project->overview) !!}
                </p>
            </div>
        </div>
    </article>

    {{--  Project Content Section  --}}
    @if(isset($project->content) && count($project->content) > 0)
        <article class="content" :class="color.isDark ? 'bg-light text-black' : 'bg-dark'">
            <div class="md:py-16 pb-20 md:pb-32 space-y-5 md:space-y-20">
                <div class="prose !max-w-full">
                    {!! $project->contentRendered !!}
                </div>
            </div>
        </article>
    @endif

    {{-- Related Cases Section --}}
    <article class="content bg-white py-16 pt-8 space-y-4 text-secondary">
        <p class="text-xl">
            Related Cases
        </p>
        <livewire:show-projects limit="3"/>
    </article>
</main>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('page', () => ({
                color: {isDark: true, rgba: 'inherit'},
                init() {
                    this.$nextTick(() => {
                        if (!this.$refs.caption) return;

                        const fac = new FastAverageColor();

                        fac.getColorAsync(this.$refs.caption)
                            .then(color => {
                                this.color = color;
                                // this.$refs.article.style.backgroundColor = color.rgba;
                                // this.$refs.article.style.color = color.isDark ? '#fff' : '#000';
                            })
                            .catch(e => {
                                console.log(e);
                            });
                    });
                }
            }))
        })
    </script>
@endpush
