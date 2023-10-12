<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-padding-top: 5rem; scroll-behavior: smooth;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    <div class="bg-base-200 drawer lg:drawer-open">
        <input id="drawer" type="checkbox" class="drawer-toggle">
        <div class="drawer-content ">
            {{-- navbar  --}}
            <livewire:layout.navigation />
            {{-- end navbar  --}}

            {{-- content  --}}
            <div class="max-w-[100vw] px-6 xl:px-6 flex flex-col justify-between h-screen">
                <!-- Page Heading -->
                <div class="flex justify-between items-center py-5">
                    @if (isset($header))
                        {{ $header }}
                    @endif
                    {{-- <div class="text-sm breadcrumbs">
                        <ul>
                            <li><a>Home</a></li>
                            <li><a>Documents</a></li>
                            <li>Add Document</li>
                        </ul>
                    </div> --}}
                </div>
                <div class="flex flex-col-reverse justify-between gap-6 xl:flex-row mb-auto">
                    <div class="prose prose-sm md:prose-base w-full max-w-full flex-grow pt-5">
                        <!-- Page Content -->
                        <main>
                            {{ $slot }}
                        </main>
                    </div>
                </div>
                <footer class="footer footer-center py-4 bg-base-200 text-xs text-base-content">
                    <aside class="flex flex-col md:flex-row w-full md:justify-between items-center">
                        <div>Copyright © {{ date('Y') }} - {{ config('app.name') }}</div>
                        <div>Made with ❤️ by Adi Arta Wibawa</div>
                    </aside>
                </footer>
            </div>
            {{-- end content  --}}

        </div>
        <div class="drawer-side z-40" style="scroll-behavior: smooth; scroll-padding-top: 5rem;">
            <label for="drawer" class="drawer-overlay" aria-label="Close menu"></label>
            {{-- sidebar --}}
            <livewire:layout.sidebar />
            {{-- end sidebar --}}
        </div>
    </div>

</body>

</html>
