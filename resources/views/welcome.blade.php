@extends('layouts.base')

@section('content')
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
                    <section id="beranda" class="flex flex-col items-center h-full justify-center"
                        x-show="activeTab === 1"
                        x-transition:enter="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-700 transform order-first"
                        x-transition:enter-start="opacity-0 -translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-300 transform absolute"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-12">
                        <div class="pt-24">
                            <livewire:welcome.beranda />
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
                            <livewire:welcome.daftar-layanan />
                        </div>
                    </section>
                </div>
                <!-- Page content here -->
                <footer class="footer footer-center pb-8 bg-base-100 text-xs text-neutral-400 max-w-[100vw] px-6 xl:px-6">
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
@endsection
