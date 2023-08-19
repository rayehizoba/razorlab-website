<x-layout>

    <section class="w-full pt-36 pb-8 bg-white min-h-[500px]">
        @if (count($posts))
            <section
                class="w-full border-t gap-x-8 gap-y-20 border-t-gray-400 pt-5 px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($posts as $post)
                    <article class="flex flex-col bg-cover relative break-words">
                        <a href="{{ route('single-post', ['slug' => $post->slug]) }}"
                            class="block mb-8 overflow-hidden relative">
                            <img src="{{ asset('assets/images/no-image.jpg') }}" alt="{{ $post->title }}"
                                class="bg-[#f1f1f1] h-full object-cover w-full " loading="lazy" />
                        </a>
                        <div class="flex flex-col flex-grow px-2">
                            <a href="{{ route('single-post', ['slug' => $post->slug]) }}" class="text-[#15171a] block relative" style="text-decoration: none">
                                <header class="block">
                                    <div
                                        class="items-left text-[#979797] flex flex-col text-[1rem] font-semibold gap-3 leading-3 mb-2">
                                        <span class="text-[#979797] ">{{ $post->category->name }}</span>
                                        <h2 class="text-[#15171a] text-2xl font-semibold m-0">{{ $post->title }}</h2>
                                    </div>
                                </header>
                                <div class="text-[18px] mt-3 max-w-[720px] overflow-y-hidden break-words"
                                    style="line-clamp: 2; -webkit-box-orient: vertical; display: -webkit-box;">
                                    {!! Str::limit($post->content, 100, '...')  !!}
                                </div>
                            </a>
                            <footer class="flex items-center gap-3 text-[#979797] text-xl mt-3 p-0">
                                <time class="flex items-center gap-3 text-[15px]">{{ $post->created_at->format('M d, Y') }}</time>
                                <span class="flex items-center gap-3 text-[15px]">. {{ceil(str_word_count(strip_tags($post->content))/200)}} {{ceil(str_word_count(strip_tags($post->content))/200) > 1 ? 'mins' : 'min'}} read</span>
                            </footer>
                        </div>
                    </article>
                @endforeach
            </section>
        @else
            <div class="min-h-[500] flex justify-center items-center">
                <h2 class="text-xl text-center font-semibold">No post available Yet</h2>
            </div>
        @endif
    </section>
</x-layout>
