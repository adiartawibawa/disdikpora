<div>
    <div class="container px-6 py-8 mx-auto lg:py-16">
        @if ($type === 'topic')
            <p class="text-md font-bold"> Topic : <span class="text-red-500 text-sm">
                    {{ $category }}</span></p>
        @elseif ($type === 'tags')
            <p class="text-md font-bold"> Tags :<span class="text-red-500 text-sm"> {{ $category }}</span>

            </p>
        @endif
        <div class="max-w-screen-xl py-6 mt-4 -mx-2 grid grid-cols-1 gap-8 xl:gap-12 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($kegiatans as $kegiatan)
                <div class="rounded overflow-hidden flex flex-col max-w-md mx-auto">
                    <a href="{{ route('kegiatan.single', $kegiatan->slug) }}">
                        <img class="w-full" src="{{ $kegiatan->featured_image_url }}"
                            alt="{{ $kegiatan->featured_image_caption }}">
                    </a>
                    <div class="relative -mt-16 px-10 pt-5 pb-16 bg-white m-5">
                        <a href="{{ route('kegiatan.single', $kegiatan->slug) }}"
                            class="font-semibold text-lg inline-block hover:text-red-600 transition duration-500 ease-in-out inline-block mb-2">
                            {{ $kegiatan->title }}
                        </a>
                        <article class="text-gray-500 text-md">
                            {!! Str::limit($kegiatan->body, 200) !!}
                        </article>
                        <p class="mt-5 text-gray-600 text-xs">
                            Kegiatan :
                            <a href="#" class="text-xs text-red-600 transition duration-500 ease-in-out">
                                {{ $kegiatan->organisation->name }}
                            </a>

                            | dalam

                            @foreach ($kegiatan->topic as $topic)
                                <a href="{{ route('kegiatan', ['type' => 'topic', 'category' => $topic->name]) }}"
                                    class="text-xs text-red-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out">
                                    {{ $topic->name }}
                                </a>
                                @unless ($loop->last)
                                    ,
                                @endunless
                            @endforeach
                        </p>
                        <p class="mt-2 text-gray-600 text-xs">
                            Waktu baca :
                            <span class="text-xs text-red-600 transition duration-500 ease-in-out">
                                {{ $kegiatan->read_time }}
                            </span>
                        </p>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
