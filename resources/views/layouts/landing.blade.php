@extends('layouts.base')

@section('content')
    <div class="relative overflow-hidden">
        <img class="absolute top-0 -left-1/4 opacity-50" src="https://tailwindui.com/img/beams-home@95.jpg" alt="">
        <div class="drawer flex flex-col md:flex-row h-screen">
            <input id="drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content overflow-y-auto flex flex-col justify-between h-screen no-scrollbar w-full md:w-[70%] "
                x-data="{ activeTab: 1 }">
                <div class="md:sticky md:top-0 md:z-10 absolute z-40 bottom-0 w-full">
                    <nav class="navbar bg-base-100 md:bg-transparent w-full">
                        <div class="flex-1">
                            <a class="btn btn-ghost normal-case text-xl">{{ config('app.name') }}</a>
                        </div>
                        <div class="flex-none md:hidden block">
                            <label for="drawer" aria-label="close sidebar" class="btn btn-square btn-ghost drawer-button">
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
                                @endauth
                            </ul>
                        </div>
                    </nav>
                </div>

                <!-- Page content here -->
                <div class="relative flex flex-col mb-auto">
                    @yield('page-content')
                </div>
                <!-- Page content here -->
                <footer
                    class="footer footer-center pb-8 mb-14 md:mb-0 bg-transparent text-xs text-neutral-400 max-w-[100vw] px-6 xl:px-6">
                    <aside class="flex flex-col md:flex-row w-full md:justify-between items-center">
                        <div>Copyright © {{ date('Y') }} - {{ config('app.name') }}</div>
                        <div>Made with ❤️ by Adi Arta Wibawa</div>
                    </aside>
                </footer>
            </div>

            <div class="drawer-side z-50">
                <label for="drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                <div class="flex flex-col justify-between min-h-full bg-base-100">
                    <ul class="menu p-4 w-64  text-base-content gap-2">
                        <!-- Sidebar content here -->
                        <li>
                            <a href="{{ route('welcome') }}">
                                <span>
                                    <x-icon-o-home class="w-5 h-5 stroke-current" />
                                </span>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('layanan.all') }}">
                                <span>
                                    <x-icon-o-ticket class="w-5 h-5 stroke-current" />
                                </span>
                                Layanan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('welcome') }}">
                                <span>
                                    <x-icon-o-information-circle class="w-5 h-5 stroke-current" />
                                </span>
                                Tentang
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('welcome') }}">
                                <span>
                                    <x-icon-o-envelope class="w-5 h-5 stroke-current" />
                                </span>
                                Kontak
                            </a>
                        </li>

                    </ul>
                    <ul class="menu p-4 w-64 min-h-full bg-base-100 text-base-content gap-2">
                        @auth
                            <li>
                                <a href="{{ url('/dashboard') }}"
                                    class="font-semibold text-slate-800 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                    wire:navigate>
                                    <span>
                                        <x-icon-o-rectangle-group class="w-5 h-5 stroke-current" />
                                    </span>
                                    Dashboard
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}"
                                    class="font-semibold text-slate-800 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                    wire:navigate>
                                    <span>
                                        <x-icon-o-arrow-right-on-rectangle class="w-5 h-5 stroke-current" />
                                    </span>
                                    Log in
                                </a>
                            </li>
                            {{-- @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}"
                                        class="ml-4 font-semibold text-slate-800 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                        wire:navigate>Register</a>
                                </li>
                            @endif --}}
                        @endauth
                    </ul>
                </div>
            </div>

            @yield('map')

        </div>
    </div>
@endsection
