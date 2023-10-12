<aside class="bg-base-100 w-80 h-screen">
    <div
        class="bg-base-100 sticky top-0 z-20 hidden items-center gap-2 bg-opacity-90 px-4 py-2 backdrop-blur lg:flex shadow-sm">
        <a href="/" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost px-2"
            data-svelte-h="svelte-pw6yxt">
            <x-application-logo class="w-8 h-8"></x-application-logo>
            <div class="font-title inline-flex text-lg md:text-2xl"><span
                    class="lowercase">{{ config('app.name') }}</span>
                <span class="uppercase text-[#1AD1A5]">UI</span>
            </div>
        </a>
        <div class="dropdown">
            <div tabindex="0" class="link link-hover font-mono text-xs">1.0.0</div>
        </div>
    </div>
    {{-- <ul class="menu bg-base-200 menu-horizontal w-full justify-between px-4 py-2 lg:hidden">
        <li><a href="/components/">Components</a></li>
        <li><a href="/blog/">Blog</a></li>
        <li><a target="_blank" href="https://github.com/saadeghi/daisyui" rel="noopener, noreferrer">GitHub</a></li>
    </ul> --}}
    <div class="h-4"></div>
    <ul class="menu menu-sm lg:menu-md px-4 py-0">
        <li>
            <a href="/docs/install/" data-sveltekit-preload-data="hover" id="" class="  ">
                <span>
                    <x-icon-o-home class="w-6 h-6 stroke-current"></x-icon-o-home>
                </span>

                <span>Install</span>
            </a>
        </li>
    </ul>

    <ul class="menu menu-sm lg:menu-md px-4 py-0">
        <li></li>
        <li class="menu-title flex flex-row gap-4"><span class="text-base-content"><svg
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-5 h-5 text-lime-600">
                    <path d="M8 16.25a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75z">
                    </path>
                    <path fill-rule="evenodd"
                        d="M4 4a3 3 0 013-3h6a3 3 0 013 3v12a3 3 0 01-3 3H7a3 3 0 01-3-3V4zm4-1.5v.75c0 .414.336.75.75.75h2.5a.75.75 0 00.75-.75V2.5h1A1.5 1.5 0 0114.5 4v12a1.5 1.5 0 01-1.5 1.5H7A1.5 1.5 0 015.5 16V4A1.5 1.5 0 017 2.5h1z"
                        clip-rule="evenodd"></path>
                </svg></span> <span>Mockup</span></li>
        <li><a href="/components/mockup-browser/" data-sveltekit-preload-data="hover" id="" class="  ">
                <span>Browser</span> </a> </li>
        <li><a href="/components/mockup-code/" data-sveltekit-preload-data="hover" id="" class="  ">
                <span>Code</span> </a> </li>
        <li><a href="/components/mockup-phone/" data-sveltekit-preload-data="hover" id="" class="  ">
                <span>Phone</span> </a> </li>
        <li><a href="/components/mockup-window/" data-sveltekit-preload-data="hover" id="" class="  ">
                <span>Window</span> </a> </li>
    </ul>
    <ul class="menu menu-sm lg:menu-md px-4 py-0"> </ul>
    <div
        class="bg-base-100 pointer-events-none sticky bottom-0 flex h-40 [mask-image:linear-gradient(transparent,#000000)]">
    </div>
</aside>
