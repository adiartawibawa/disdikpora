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

    <link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

</head>

<body class="font-sans antialiased">
    <div>
        <div class="bg-base-200 drawer lg:drawer-open">
            <input id="drawer" type="checkbox" class="drawer-toggle">
            <div class="drawer-content">
                {{-- navbar  --}}
                <livewire:layout.navigation />
                {{-- end navbar  --}}
                <div class="flex flex-col h-screen justify-between">
                    {{-- content  --}}
                    <div class="max-w-[100vw] px-6 xl:px-6 pb-16 mb-auto bg-base-200">
                        <!-- Page Heading -->
                        <div class="flex justify-between items-center pt-5">
                            @if (isset($header))
                                {{ $header }}
                            @endif
                            <div class="text-sm breadcrumbs text-slate-500 hidden md:block">
                                <ul>
                                    @if (isset($breadcrumbs))
                                        {{ $breadcrumbs }}
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse justify-between gap-6 xl:flex-row">
                            <div class="flex flex-col gap-6 pt-10 w-full">
                                <!-- Page Content -->
                                <main class="max-w-full flex-grow">

                                    <x-notifications />

                                    {{ $slot }}
                                </main>
                            </div>
                        </div>

                    </div>
                    {{-- end content  --}}
                    {{-- Footer --}}
                    <livewire:layout.footer />
                </div>
            </div>

            <div class="drawer-side z-40" style="scroll-behavior: smooth; scroll-padding-top: 5rem;">
                <label for="drawer" class="drawer-overlay" aria-label="Close menu"></label>
                {{-- sidebar --}}
                <livewire:layout.sidebar />
                {{-- end sidebar --}}
            </div>
        </div>
    </div>

    @livewire('wire-elements-modal')

    @livewireChartsScripts

    @stack('scripts')
</body>

</html>
