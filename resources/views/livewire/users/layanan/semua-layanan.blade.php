<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Layanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <section class="bg-white dark:bg-gray-900 rounded-lg">
                <div class="container px-6 py-12 mx-auto">
                    <h1 class="text-xl font-semibold text-gray-800 lg:text-2xl dark:text-white">
                        Layanan Kami
                    </h1>

                    @foreach ($layanan as $item)
                        <div class="mt-4 space-y-8 lg:mt-6">
                            <div x-data="{ open: false }" class="p-8 bg-gray-100 rounded-lg dark:bg-gray-800">
                                <dt @click="open = !open">
                                    <button class="flex items-center justify-between w-full">
                                        <h1 class="font-semibold" :class="open ? 'text-transparent' : 'text-gray-700'">
                                            {{ $item->nama }}
                                        </h1>

                                        <span class="rounded-full"
                                            :class="open ? 'bg-gray-200 text-gray-400' : 'bg-red-500 text-white'">
                                            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18 12H6" />
                                            </svg>
                                            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </span>
                                    </button>
                                </dt>

                                <dd class="p-3 space-y-4" x-show="open"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform -translate-y-6"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100 transform translate-y-0"
                                    x-transition:leave-end="opacity-0 transform -translate-y-6">
                                    <div class="container px-6 py-10 mx-auto">
                                        <div class="lg:-mx-6 lg:flex lg:items-center">
                                            <img class="object-cover object-center lg:w-1/2 lg:mx-6 w-full h-72 rounded-lg"
                                                src="{{ $item->ilustrasi_url }}" alt="">

                                            <div class="mt-8 lg:w-1/2 lg:px-6 lg:mt-0">
                                                <h1
                                                    class="text-2xl font-semibold text-gray-800 dark:text-white lg:text-3xl lg:w-96">
                                                    {{ $item->nama }}
                                                </h1>

                                                <p class="max-w-lg mt-6 text-gray-500 dark:text-gray-400 ">
                                                    {{ $item->desc }}
                                                </p>

                                                <div class="inline-flex mt-6 items-center justify-center space-x-2">
                                                    <h3 class="text-md font-medium">Estimasi Layanan : <span
                                                            class=" text-red-500">{{ $item->estimasi }} Hari
                                                            Kerja </span>
                                                    </h3>

                                                    <p> | </p>

                                                    <button wire:click="openModal('{{ $item->slug }}')"
                                                        class="text-sm text-gray-700 underline"> Lihat Panduan
                                                    </button>
                                                </div>

                                                <div class="flex items-center justify-between mt-12 lg:justify-start">
                                                    <a href="{{ route('user.permohonan.create', $item->slug) }}"
                                                        class="bg-red-500 px-4 py-2 rounded-full inline-flex items-center justify-center text-white w-full uppercase">Saya
                                                        ingin
                                                        mengajukan permohonan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </dd>

                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <x-filament::modal sticky-header width="5xl" id="modals">
        @empty($panduanLayanan->panduan)
        @else
            <x-slot name="heading">
                {{ $panduanLayanan->nama }}
            </x-slot>

            <x-slot name="description">
                <div class="text-sm">
                    <span class="font-semibold">Estimasi layanan : </span>
                    <span class="text-red-500">{{ $panduanLayanan->estimasi }} Hari</span>
                </div>
                <div class="mt-2 text-sm">
                    {{ $panduanLayanan->desc }}
                </div>
            </x-slot>

            <div class="px-6">
                @foreach ($panduanLayanan->panduan as $panduan)
                    @if ($loop->first)
                        <div class="flex flex-col-reverse w-full md:flex-row-reverse items-start justify-end gap-4">
                            <div
                                class="flex w-full md:w-1/2 items-start gap-4  bg-white px-6 pt-6 pb-10 rounded-lg shadow-xl">
                                <div class="rounded-full bg-red-500 px-4 py-2 text-white">{{ $loop->iteration }}</div>
                                <div class="text-slate-600">
                                    <div class="text-2xl font-bold">{{ $panduan['judul'] }}</div>
                                    <article class="prose text-sm text-slate-500">{!! $panduan['konten'] !!}</article>
                                    @if ($panduan['file'] != null)
                                        <a href="{{ url('/') . '/storage/' . $panduan['file'] }}" target="_blank"
                                            class="inline-flex items-center mt-4 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-red-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                            <svg class="w-3.5 h-3.5 mr-2.5" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                            Panduan {{ $panduan['judul'] }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <img class="h-64 w-full rounded-lg object-cover shadow-xl"
                                    src="{{ url('/') . '/storage/' . $panduan['image_header'] }}"
                                    alt="{{ $loop->iteration }}" />
                            </div>
                        </div>
                    @else
                        @if ($loop->iteration % 2 == 0)
                            <!-- left to right -->
                            <div class="mx-auto my-4 h-32 max-w-[10rem] md:max-w-md">
                                <div class="flex h-full flex-row-reverse">
                                    <div
                                        class="mt-[62px] h-16 w-1/2 rounded-tr-lg border-r-2 border-t-2 border-dashed border-gray-300">
                                    </div>
                                    <div
                                        class="h-16 w-1/2 rounded-bl-lg border-b-2 border-l-2 border-dashed border-gray-300">
                                    </div>
                                </div>
                            </div>

                            <!-- direction flex row  -->
                            <div class="flex flex-col-reverse w-full md:flex-row items-start justify-end gap-4">
                                <div
                                    class="flex w-full md:w-1/2 items-start gap-4  bg-white px-6 pt-6 pb-10 rounded-lg shadow-xl">
                                    <div class="rounded-full bg-red-500 px-4 py-2 text-white">
                                        {{ $loop->iteration }}
                                    </div>
                                    <div class="text-slate-600">
                                        <div class="text-2xl font-bold">{{ $panduan['judul'] }}</div>
                                        <article class="prose text-sm text-slate-500">{!! $panduan['konten'] !!}</article>
                                        @if ($panduan['file'] != null)
                                            <a href="{{ url('/') . '/storage/' . $panduan['file'] }}" target="_blank"
                                                class="inline-flex items-center mt-4 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-red-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                                <svg class="w-3.5 h-3.5 mr-2.5" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>
                                                Panduan {{ $panduan['judul'] }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2">
                                    <img class="h-64 w-full rounded-lg object-cover shadow-xl"
                                        src="{{ url('/') . '/storage/' . $panduan['image_header'] }}"
                                        alt="{{ $panduan['judul'] }}" />
                                </div>
                            </div>
                        @else
                            <!-- right to left -->
                            <div class="mx-auto my-4 h-32 max-w-[15rem] md:max-w-md">
                                <div class="grid h-full grid-cols-2">
                                    <div
                                        class="mt-[62px] h-16 rounded-tl-lg border-l-2 border-t-2 border-dashed border-gray-300">
                                    </div>
                                    <div class="h-16 rounded-br-lg border-b-2 border-r-2 border-dashed border-gray-300">
                                    </div>
                                </div>
                            </div>

                            <!-- direction flex row reverse  -->
                            <div class="flex flex-col-reverse w-full md:flex-row-reverse items-start justify-end gap-4">
                                <div
                                    class="flex w-full md:w-1/2 items-start gap-4  bg-white px-6 pt-6 pb-10 rounded-lg shadow-xl">
                                    <div class="rounded-full bg-red-500 px-4 py-2 text-white">
                                        {{ $loop->iteration }}
                                    </div>
                                    <div class="text-slate-600">
                                        <div class="text-2xl font-bold">{{ $panduan['judul'] }}</div>
                                        <article class="prose text-sm text-slate-500">{!! $panduan['konten'] !!}</article>
                                        @if ($panduan['file'] != null)
                                            <a href="{{ url('/') . '/storage/' . $panduan['file'] }}" target="_blank"
                                                class="inline-flex items-center mt-4 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-red-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                                <svg class="w-3.5 h-3.5 mr-2.5" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>
                                                Panduan {{ $panduan['judul'] }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2">
                                    <img class="h-64 w-full rounded-lg object-cover shadow-xl"
                                        src="{{ url('/') . '/storage/' . $panduan['image_header'] }}"
                                        alt="{{ $panduan['judul'] }}" />
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        @endempty
        <x-slot name="footerActions">
            <div class="mx-auto">
                <button wire:click="closeModal()"
                    class="bg-red-500 px-4 py-2 rounded-md text-white hover:bg-red-700">Saya
                    Mengerti!</button>
            </div>
        </x-slot>
    </x-filament::modal>
</div>
