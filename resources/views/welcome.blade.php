<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

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
</head>

<body class="antialiased h-screen bg-white">
    <div class="relative">

        <div class="drawer flex flex-col md:flex-row h-screen">
            <input id="drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content overflow-y-auto flex flex-col justify-between h-screen no-scrollbar w-full md:w-[70%] "
                x-data="{ activeTab: 2 }">
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
                                <li>
                                    <button id="beranda" :class="activeTab === 1 ? 'bg-base-200' : 'bg-base-100'"
                                        :tabindex="activeTab === 1 ? 0 : -1" :aria-selected="activeTab === 1"
                                        aria-controls="tabpanel-1" @click="activeTab = 1"
                                        @focus="activeTab = 1">Beranda</button>
                                </li>
                                <li><button id="layanan" :class="activeTab === 2 ? 'bg-base-200' : 'bg-base-100'"
                                        :tabindex="activeTab === 2 ? 0 : -1" :aria-selected="activeTab === 2"
                                        aria-controls="tabpanel-2" @click="activeTab = 2"
                                        @focus="activeTab = 2">Layanan</button></li>
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
                    <section id="beranda" class="py-24 flex items-center h-full justify-center bg-white"
                        x-show="activeTab === 1"
                        x-transition:enter="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-700 transform order-first"
                        x-transition:enter-start="opacity-0 -translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-300 transform absolute"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-12">
                        <div class="mx-auto max-w-[43rem]">
                            <div class="text-center">
                                <p class="text-lg font-medium leading-8 text-indigo-600/95">Lorem ipsum dolor sit amet
                                    consectetur adipisicing elit.</p>
                                <h1 class="mt-3 text-[3.5rem] font-bold leading-[4rem] tracking-tight text-black">
                                    Distribute your brand from&nbsp;design to code</h1>
                                <p class="mt-3 text-lg leading-relaxed text-slate-400">Specify helps you unify your
                                    brand identity by collecting, storing and distributing design tokens and assets —
                                    automatically.</p>
                            </div>

                            <div class="mt-6 flex items-center justify-center gap-4">
                                <a href="#"
                                    class="transform rounded-md bg-indigo-600/95 px-5 py-3 font-medium text-white transition-colors hover:bg-indigo-700">Get
                                    started for free</a>
                                <a href="#"
                                    class="transform rounded-md border border-slate-200 px-5 py-3 font-medium text-slate-900 transition-colors hover:bg-slate-50">
                                    Request a demo </a>
                            </div>
                        </div>
                    </section>

                    {{-- section panduan --}}
                    <section id="panduan" class="flex flex-col items-center h-full justify-center"
                        x-show="activeTab === 2"
                        x-transition:enter="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-700 transform order-first"
                        x-transition:enter-start="opacity-0 -translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-300 transform absolute"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-12">
                        <div class="py-20">
                            <div class="mx-auto px-6 xl:container md:px-12">
                                <div class="mb-16 md:w-2/3 lg:w-1/2">
                                    <h2 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white md:text-4xl">Tailus
                                        blocks leadership</h2>
                                    <p class="text-gray-600 dark:text-gray-300">Tailus prides itself not only on
                                        award-winning technology, but also on the talent of its people of some of the
                                        brightest minds and most experienced executives in business.</p>
                                </div>
                                <div class="grid gap-6 px-4 sm:grid-cols-2 sm:px-0 md:grid-cols-3">
                                    <div class="group relative space-y-6 overflow-hidden rounded-3xl">
                                        <img class="ransition mx-auto h-[26rem] w-full object-cover object-top grayscale duration-500 group-hover:scale-105 group-hover:grayscale-0"
                                            src="images/woman1.jpg" alt="woman" loading="lazy" width="640"
                                            height="805" />
                                        <div
                                            class="absolute inset-x-0 bottom-0 mt-auto h-max translate-y-24 bg-gray-800 px-8 py-6 transition duration-300 ease-in-out group-hover:translate-y-0 dark:bg-white">
                                            <div>
                                                <h4 class="text-xl font-semibold text-white dark:text-gray-700">Hentoni
                                                    Doe</h4>
                                                <span class="block text-sm text-gray-500">CEO-Founder</span>
                                            </div>
                                            <p class="mt-8 text-gray-300 dark:text-gray-600">Quae labore quia tempora
                                                dolor impedit. Possimus, sint ducimus ipsam?</p>
                                        </div>
                                    </div>
                                    <div class="group relative space-y-6 overflow-hidden rounded-3xl">
                                        <img class="ransition mx-auto h-[26rem] w-full object-cover object-top grayscale duration-500 group-hover:scale-105 group-hover:grayscale-0"
                                            src="images/woman.jpg" alt="woman" loading="lazy" width="640"
                                            height="805" />
                                        <div
                                            class="absolute inset-x-0 bottom-0 mt-auto h-max translate-y-24 bg-gray-800 px-8 py-6 transition duration-300 ease-in-out group-hover:translate-y-0 dark:bg-white">
                                            <div>
                                                <h4 class="text-xl font-semibold text-white dark:text-gray-700">Hentoni
                                                    Doe</h4>
                                                <span class="block text-sm text-gray-500">CEO-Founder</span>
                                            </div>
                                            <p class="mt-8 text-gray-300 dark:text-gray-600">Quae labore quia tempora
                                                dolor impedit. Possimus, sint ducimus ipsam?</p>
                                        </div>
                                    </div>
                                    <div class="group relative space-y-6 overflow-hidden rounded-3xl">
                                        <img class="mx-auto h-[26rem] w-full object-cover object-top grayscale transition duration-500 group-hover:scale-105 group-hover:grayscale-0"
                                            src="images/man.jpg" alt="woman" loading="lazy" width="640"
                                            height="805" />
                                        <div
                                            class="absolute inset-x-0 bottom-0 mt-auto h-max translate-y-24 bg-gray-800 px-8 py-6 transition duration-300 ease-in-out group-hover:translate-y-0 dark:bg-white">
                                            <div>
                                                <h4 class="text-xl font-semibold text-white dark:text-gray-700">Hentoni
                                                    Doe</h4>
                                                <span class="block text-sm text-gray-500">CEO-Founder</span>
                                            </div>
                                            <p class="mt-8 text-gray-300 dark:text-gray-600">Quae labore quia tempora
                                                dolor impedit. Possimus, sint ducimus ipsam?</p>
                                        </div>
                                    </div>
                                    <div class="group relative space-y-6 overflow-hidden rounded-3xl">
                                        <img class="ransition mx-auto h-[26rem] w-full object-cover object-top grayscale duration-500 group-hover:scale-105 group-hover:grayscale-0"
                                            src="images/woman1.jpg" alt="woman" loading="lazy" width="640"
                                            height="805" />
                                        <div
                                            class="absolute inset-x-0 bottom-0 mt-auto h-max translate-y-24 bg-gray-800 px-8 py-6 transition duration-300 ease-in-out group-hover:translate-y-0 dark:bg-white">
                                            <div>
                                                <h4 class="text-xl font-semibold text-white dark:text-gray-700">Hentoni
                                                    Doe</h4>
                                                <span class="block text-sm text-gray-500">CEO-Founder</span>
                                            </div>
                                            <p class="mt-8 text-gray-300 dark:text-gray-600">Quae labore quia tempora
                                                dolor impedit. Possimus, sint ducimus ipsam?</p>
                                        </div>
                                    </div>
                                    <div class="group relative space-y-6 overflow-hidden rounded-3xl">
                                        <img class="mx-auto h-[26rem] w-full object-cover object-top grayscale transition duration-500 group-hover:scale-105 group-hover:grayscale-0"
                                            src="images/man.jpg" alt="woman" loading="lazy" width="640"
                                            height="805" />
                                        <div
                                            class="absolute inset-x-0 bottom-0 mt-auto h-max translate-y-24 bg-gray-800 px-8 py-6 transition duration-300 ease-in-out group-hover:translate-y-0 dark:bg-white">
                                            <div>
                                                <h4 class="text-xl font-semibold text-white dark:text-gray-700">Hentoni
                                                    Doe</h4>
                                                <span class="block text-sm text-gray-500">CEO-Founder</span>
                                            </div>
                                            <p class="mt-8 text-gray-300 dark:text-gray-600">Quae labore quia tempora
                                                dolor impedit. Possimus, sint ducimus ipsam?</p>
                                        </div>
                                    </div>
                                    <div class="group relative space-y-6 overflow-hidden rounded-3xl">
                                        <img class="ransition mx-auto h-[26rem] w-full object-cover object-top grayscale duration-500 group-hover:scale-105 group-hover:grayscale-0"
                                            src="images/woman1.jpg" alt="woman" loading="lazy" width="640"
                                            height="805" />
                                        <div
                                            class="absolute inset-x-0 bottom-0 mt-auto h-max translate-y-24 bg-gray-800 px-8 py-6 transition duration-300 ease-in-out group-hover:translate-y-0 dark:bg-white">
                                            <div>
                                                <h4 class="text-xl font-semibold text-white dark:text-gray-700">Hentoni
                                                    Doe</h4>
                                                <span class="block text-sm text-gray-500">CEO-Founder</span>
                                            </div>
                                            <p class="mt-8 text-gray-300 dark:text-gray-600">Quae labore quia tempora
                                                dolor impedit. Possimus, sint ducimus ipsam?</p>
                                        </div>
                                    </div>
                                </div>
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
