<x-layout>
    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    @endpush
    <section class="w-full pt-36 pb-8 bg-white min-h-[500px] px-6">
        @if ($post)
            <section class="max-w-2xl mx-auto">
                <h3 class="text-[#979797]">{{ $post->category->name }}</h3>
                <h2 class="text-5xl text-[#15171a] font-extrabold py-6 leading-[3.5rem] capitalize"
                    style="letter-spacing: 0.025rem">{{ $post->title }}</h2>
                <div class="flex">
                    <div
                        class="bg-[#979797] mr-4 h-16 w-16 rounded-full overflow-hidden grid justify-center items-center">
                        <img src="{{ asset('assets/images/user-image.png') }}" alt="{{ $post->author->name }}"
                            class="bg-cover text-[#979797] h-16 w-16 rounded-full">
                    </div>
                    <div class="flex flex-col align-middle justify-center">
                        <h3 class="text-xl text-[#15171a] font-semibold">{{ $post->author->name }}</h3>
                        <footer class="flex-col text-[#979797] text-xl p-0">
                            <time class="font-light text-[17px]">{{ $post->created_at->format('M d, Y') }}</time>
                            <span class="font-light text-[17px]">.
                                {{ ceil(str_word_count(strip_tags($post->content)) / 200) }}
                                {{ ceil(str_word_count(strip_tags($post->content)) / 200) > 1 ? 'mins' : 'min' }}
                                read</span>
                        </footer>
                    </div>
                </div>
                <div class="my-12 w-full bg-[#afaeae] h-[23rem]">
                    @if ($post->cover_image === '')
                        <img src="{{ asset('assets/images/no-image.jpg') }}" alt="{{ $post->title }}"
                            class="bg-cover h-[23rem] w-full text-[#979797]">
                    @else
                        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}"
                            class="bg-cover h-[23rem] w-full text-[#979797]">
                    @endif

                </div>
                <article class="text-[#15171a] text-[1.08rem] leading-8"
                    style="font-family: 'Merriweather', serif; word-spacing: 2px">
                    {!! $post->content !!}
                </article>
            </section>
        @else
            <div class="min-h-[500px] flex justify-center items-center">
                <div class="block text-center">
                    <h2 class="text-8xl text-[#15171a] font-extrabold">404</h2>
                    <h3 class="text-2xl text-center font-semibold text-[#15171a]">The post is unavailable</h3>
                    <p class="text-sm text-[#979797] mb-6">The post is either removed or you entered invalid url</p>
                    <a href="{{ route('blog') }}" class="text-[#0f0f0f] text-md">Go to the blog page</a>
                </div>

            </div>
        @endif
    </section>
</x-layout>
