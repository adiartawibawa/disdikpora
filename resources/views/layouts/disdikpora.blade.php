<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-padding-top: 5rem; scroll-behavior: smooth;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')

    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/MarkerCluster.Default.min.css"
        integrity="sha512-fYyZwU1wU0QWB4Yutd/Pvhy5J1oWAwFXun1pt+Bps04WSe4Aq6tyHlT4+MHSJhD8JlLfgLuC4CbCnX5KHSjyCg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/leaflet.markercluster.min.js"
        integrity="sha512-TiMWaqipFi2Vqt4ugRzsF8oRoGFlFFuqIi30FFxEPNw58Ov9mOy6LgC05ysfkxwLE0xVeZtmr92wVg9siAFRWA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

</head>

<body class="antialiased h-screen bg-white">
    <div class="relative">
        <div class="drawer flex flex-col md:flex-row h-screen">
            <input id="drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content overflow-y-auto flex flex-col justify-between h-screen no-scrollbar w-full md:w-[70%] "
                x-data="{ activeTab: 1 }">
                <div class="md:sticky md:top-0 md:z-10 shadow-sm absolute z-40 bottom-0 w-full">
                    <nav class="navbar bg-base-100 w-full">
                        <div class="flex-1">
                            <a class="btn btn-ghost normal-case text-xl">{{ config('app.name') }}</a>
                        </div>
                        <div class="flex-none md:hidden block">
                            <label for="drawer" aria-label="close sidebar"
                                class="btn btn-square btn-ghost drawer-button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="inline-block w-5 h-5 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                    </path>
                                </svg>
                            </label>
                        </div>
                        <div class="flex-none hidden md:block">
                            <ul role="tablist" @keydown.right.prevent.stop="$focus.wrap().next()"
                                @keydown.left.prevent.stop="$focus.wrap().prev()"
                                @keydown.home.prevent.stop="$focus.first()" @keydown.end.prevent.stop="$focus.last()"
                                class="menu menu-horizontal px-1 gap-1">
                                <li><button>Beranda</button></li>
                                <li>
                                    <button id="layanan" :class="activeTab === 1 ? 'bg-base-200' : 'bg-base-100'"
                                        :tabindex="activeTab === 1 ? 0 : -1" :aria-selected="activeTab === 1"
                                        aria-controls="tabpanel-1" @click="activeTab = 1"
                                        @focus="activeTab = 1">Layanan</button>
                                </li>
                                <li><button id="panduan" :class="activeTab === 2 ? 'bg-base-200' : 'bg-base-100'"
                                        :tabindex="activeTab === 2 ? 0 : -1" :aria-selected="activeTab === 2"
                                        aria-controls="tabpanel-2" @click="activeTab = 2"
                                        @focus="activeTab = 2">Panduan</button></li>
                                <li><button>Tentang</button></li>
                                <li><button>Kontak</button></li>
                                @auth
                                    <li>
                                        <a href="{{ url('/dashboard') }}"
                                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                            wire:navigate>Dashboard</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('login') }}"
                                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                            wire:navigate>Log in</a>
                                    </li>
                                    {{-- @if (Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}"
                                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                            wire:navigate>Register</a>
                                    </li>
                                @endif --}}
                                @endauth
                            </ul>
                        </div>
                    </nav>
                </div>

                <!-- Page content here -->
                <div class="relative flex flex-col mb-auto">
                    {{-- section layanan --}}
                    <section id="layanan"
                        class="w-full h-full bg-white  min-[480px]:flex items-stretch focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300"
                        x-show="activeTab === 1"
                        x-transition:enter="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-700 transform order-first"
                        x-transition:enter-start="opacity-0 -translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-300 transform absolute"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-12">
                        <div class="container px-6 py-10 mx-auto">
                            <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">
                                explore
                                our <br> awesome <span class="text-blue-500">Components</span></h1>

                            <iframe class="min-w-full mt-12 h-64 md:h-[450px] rounded-xl overflow-hidden"
                                src="https://vimeo.com/showcase/7060635/video/525707984/embed" frameborder="0"
                                allow="autoplay; fullscreen" allowfullscreen=""></iframe>

                            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 md:grid-cols-2">
                                <div class="p-6 border rounded-xl border-r-gray-200 dark:border-gray-700">
                                    <div class="md:flex md:items-start md:-mx-4">
                                        <span
                                            class="inline-block p-2 text-blue-500 bg-blue-100 rounded-xl md:mx-4 dark:text-white dark:bg-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                            </svg>
                                        </span>

                                        <div class="mt-4 md:mx-4 md:mt-0">
                                            <h1 class="text-xl font-medium text-gray-700 capitalize dark:text-white">
                                                Copy &
                                                paste components</h1>

                                            <p class="mt-3 text-gray-500 dark:text-gray-300">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident ab
                                                nulla
                                                quod dignissimos vel non corrupti doloribus voluptatum eveniet
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 border rounded-xl border-r-gray-200 dark:border-gray-700">
                                    <div class="md:flex md:items-start md:-mx-4">
                                        <span
                                            class="inline-block p-2 text-blue-500 bg-blue-100 rounded-xl md:mx-4 dark:text-white dark:bg-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                            </svg>
                                        </span>

                                        <div class="mt-4 md:mx-4 md:mt-0">
                                            <h1 class="text-xl font-medium text-gray-700 capitalize dark:text-white">
                                                Zero
                                                Configuration</h1>

                                            <p class="mt-3 text-gray-500 dark:text-gray-300">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident ab
                                                nulla
                                                quod dignissimos vel non corrupti doloribus voluptatum eveniet
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 border rounded-xl border-r-gray-200 dark:border-gray-700">
                                    <div class="md:flex md:items-start md:-mx-4">
                                        <span
                                            class="inline-block p-2 text-blue-500 bg-blue-100 rounded-xl md:mx-4 dark:text-white dark:bg-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                                            </svg>
                                        </span>

                                        <div class="mt-4 md:mx-4 md:mt-0">
                                            <h1 class="text-xl font-medium text-gray-700 capitalize dark:text-white">
                                                elegant Dark Mode</h1>

                                            <p class="mt-3 text-gray-500 dark:text-gray-300">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident ab
                                                nulla
                                                quod dignissimos vel non corrupti doloribus voluptatum eveniet
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 border rounded-xl border-r-gray-200 dark:border-gray-700">
                                    <div class="md:flex md:items-start md:-mx-4">
                                        <span
                                            class="inline-block p-2 text-blue-500 bg-blue-100 rounded-xl md:mx-4 dark:text-white dark:bg-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                            </svg>
                                        </span>

                                        <div class="mt-4 md:mx-4 md:mt-0">
                                            <h1 class="text-xl font-medium text-gray-700 capitalize dark:text-white">
                                                Simple
                                                & clean designs</h1>

                                            <p class="mt-3 text-gray-500 dark:text-gray-300">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident ab
                                                nulla
                                                quod dignissimos vel non corrupti doloribus voluptatum eveniet
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- section panduan --}}
                    <section id="panduan"
                        class="w-full h-full bg-white  min-[480px]:flex items-stretch focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300"
                        x-show="activeTab === 2"
                        x-transition:enter="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-700 transform order-first"
                        x-transition:enter-start="opacity-0 -translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-300 transform absolute"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-12">
                        <figure class="min-[480px]:w-1/2 p-2">
                            <img class="w-full h-[180px] min-[480px]:h-full object-cover rounded-lg" width="304"
                                height="214" src="./tabs-image-01.jpg" alt="Tab 01" />
                        </figure>
                        <div class="min-[480px]:w-1/2 flex flex-col justify-center p-5 pl-3">
                            <div class="flex justify-between mb-1">
                                <header>
                                    <div class="font-caveat text-xl font-medium text-sky-500">Panduan</div>
                                    <h1 class="text-xl font-bold text-slate-900">Lassen Peak</h1>
                                </header>
                                <button
                                    class="shrink-0 h-[30px] w-[30px] border border-slate-200 hover:border-slate-300 rounded-full shadow inline-flex items-center justify-center focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 transition-colors duration-150 ease-in-out"
                                    aria-label="Like">
                                    <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="14"
                                        height="13">
                                        <path
                                            d="M6.985 1.635C5.361.132 2.797.162 1.21 1.7A3.948 3.948 0 0 0 0 4.541a3.948 3.948 0 0 0 1.218 2.836l5.156 4.88a.893.893 0 0 0 1.223 0l5.165-4.886a3.925 3.925 0 0 0 .061-5.663C11.231.126 8.62.094 6.985 1.635Zm4.548 4.53-4.548 4.303-4.54-4.294a2.267 2.267 0 0 1 0-3.275 2.44 2.44 0 0 1 3.376 0c.16.161.293.343.398.541a.915.915 0 0 0 .766.409c.311 0 .6-.154.767-.409.517-.93 1.62-1.401 2.677-1.142 1.057.259 1.797 1.181 1.796 2.238a2.253 2.253 0 0 1-.692 1.63Z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="text-slate-500 text-sm line-clamp-3 mb-2">It is a long established fact that a
                                reader will be distracted by the readable content of a page when looking at its layout.
                            </div>
                            <div class="text-right">
                                <a class="text-sm font-medium text-indigo-500 hover:text-indigo-600 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 transition-colors duration-150 ease-out"
                                    href="#0">Read more -&gt;</a>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Page content here -->
                <footer
                    class="footer footer-center pb-8 bg-base-100 text-xs text-neutral-400 max-w-[100vw] px-6 xl:px-6">
                    <aside class="flex flex-col md:flex-row w-full md:justify-between items-center">
                        <div>Copyright © {{ date('Y') }} - {{ config('app.name') }}</div>
                        <div>Made with ❤️ by Adi Arta Wibawa</div>
                    </aside>
                </footer>
            </div>

            <div class="drawer-side z-50">
                <label for="drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu p-4 w-64 min-h-full bg-base-100 text-base-content">
                    <!-- Sidebar content here -->
                    <li><a>Layanan</a></li>
                    <li><a>Panduan</a></li>
                    <li><a>Tentang</a></li>
                    <li><a>Kontak</a></li>
                    @auth
                        <li>
                            <a href="{{ url('/dashboard') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                wire:navigate>Dashboard</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                wire:navigate>Log in</a>
                        </li>
                        {{-- @if (Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}"
                                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                            wire:navigate>Register</a>
                                    </li>
                                @endif --}}
                    @endauth
                </ul>
            </div>

            <aside class="w-full md:w-[30%] bg-red-600">
                <div class="z-10 sticky">
                    <livewire:welcome.school-map />
                </div>
            </aside>
        </div>
    </div>
</body>

</html>
