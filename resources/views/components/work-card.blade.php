@props([
'project',
'displaced' => false,
])

<div
    class="js-delayed-sectionn"
    x-data="WorkCard"
    :data-scrub="scrubs[Math.floor(Math.random() * scrubs.length)]"
    @if($displaced)
    :style="{ marginTop: `${displacements[Math.floor(Math.random() * displacements.length)]}px` }"
    @endif
>
    <a
        href="{{ route('work', ['slug' => $project->slug]) }}"
        @mouseenter="mouseEnter"
        @mouseleave="mouseLeave"
        class="block group relative {{ isset($project->thumbnail_mask) ? '':'md:cursor-none' }}"
    >
        <div class="group-hover:scale-105 transform transition duration-500 transform-gpu">
            <div class="js-delayed-container -z-10 will-change-transform transform-gpu">
                <div
                    x-ref="container"
                    class="js-delayed-img relative transform-gpu will-change-transform"
                >
                    @switch(\Storage::disk('public')->mimeType($project->thumbnail))
                        @case('video/mp4')
                        <video
                            x-ref="video"
                            preload="auto" playsinline loop muted
                            class="aspect-video w-full object-cover bg-secondary-alt"
                        >
                            <source src="{{ $project->thumbnail_url }}" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                        @break

                        @default
                        <img
                            class="aspect-video w-full object-cover bg-secondary-alt"
                            src="{{ $project->thumbnail_url }}"
                            alt="{{ $project->name }}"
                        />
                        @break
                    @endswitch

                    @isset($project->thumbnail_mask)
                        @switch(\Storage::disk('public')->mimeType($project->thumbnail_mask))
                            @case('video/mp4')
                            <video
                                x-ref="mask"
                                preload="auto" playsinline loop muted
                                class="absolute inset-0 aspect-video w-full object-cover bg-secondary-alt"
                            >
                                <source src="{{ $project->thumbnail_mask_url }}" type="video/mp4">
                                Your browser does not support HTML5 video.
                            </video>
                            @break

                            @default
                            <img
                                x-ref="mask"
                                class="absolute inset-0 aspect-video w-full object-cover bg-secondary-alt"
                                src="{{ $project->thumbnail_mask_url }}"
                                alt="{{ $project->name }}"
                            />
                            @break
                        @endswitch
                    @endisset
                </div>
            </div>
        </div>
        <p class="text-xl font-light tracking-wide mt-1 z-0 relative mix-blend-difference invert text-secondary">
            {{ $project->name }}
        </p>
        <p class="text-xs mt-3 md:mt-6 z-0 relative mix-blend-difference invert text-secondary-alt/50">
            {{ $project->services->pluck('name')->map(fn($name) => \Str::singular($name))->implode(', ') }}
        </p>
    </a>

    @once
        @push('scripts')
            <script>
                const scrubs = [0.075, 0.1, 0.125];
                const displacements = [0, -20, 0, -30, 0, 10, 0, -10, 0, 20];

                document.addEventListener('livewire:load', function () {
                    Alpine.data('WorkCard', () => ({
                        init() {
                            (() => {
                                const cursor = document.querySelector("[data-magic-cursor]");
                                const container = this.$refs.container;
                                const mask = this.$refs.mask;
                                const maxClipPathSize = '20%';

                                if (!mask) return;

                                mask.style.opacity = 0;

                                container.addEventListener('mouseenter', e => {
                                    gsap.fromTo(
                                        mask,
                                        {"clip-path": getClipPath(e), opacity: 1},
                                        {"clip-path": getClipPath(e, maxClipPathSize)}
                                    );
                                    cursor.style.zIndex = -10;
                                });

                                container.addEventListener('mousemove', e => {
                                    gsap.to(mask, {"clip-path": getClipPath(e, maxClipPathSize)});
                                });

                                container.addEventListener('mouseleave', e => {
                                    gsap
                                        .to(mask, {"clip-path": getClipPath(e)},)
                                        .then(() => {
                                            gsap.set(mask, {"clip-path": 'circle(100% at 50% 50%)', opacity: 0});
                                        });
                                    cursor.style.zIndex = 10;
                                });
                            })();
                        },
                        mouseEnter() {
                            if (this.$refs.video) this.$refs.video.play();
                            if (this.$refs.mask && this.$refs.mask.tagName == 'VIDEO') this.$refs.mask.play();
                        },
                        mouseLeave() {
                            if (this.$refs.video) {
                                this.$refs.video.pause();
                                this.$refs.video.currentTime = 0;
                            }
                            if (this.$refs.mask && this.$refs.mask.tagName == 'VIDEO') {
                                this.$refs.mask.pause();
                                this.$refs.mask.currentTime = 0;
                            }
                        }
                    }));
                });
            </script>
        @endpush
    @endonce
</div>
