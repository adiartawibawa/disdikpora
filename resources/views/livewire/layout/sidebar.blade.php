<aside class="bg-base-100 w-80">
    <div
        class="bg-base-100 sticky top-0 z-20 hidden items-center gap-2 bg-opacity-90 px-4 py-2 backdrop-blur lg:flex shadow-sm">
        <a href="{{ route('dashboard') }}" wire:navigate aria-current="page" aria-label="Homepage"
            class="flex-0 btn btn-ghost px-2">
            <x-application-logo class="w-8 h-8" />
            <div class="font-title inline-flex text-lg md:text-2xl"><span
                    class="lowercase">{{ config('app.name') }}</span>
                <span class="uppercase text-[#1AD1A5]">UI</span>
            </div>
        </a>
        <div class="dropdown">
            <div tabindex="0" class="link link-hover font-mono text-xs">1.0.0</div>
        </div>
    </div>

    <div class="h-4"></div>

    <div class="min-h-screen">
        <ul class="menu menu-sm lg:menu-md px-4 py-0 gap-2">
            <li>
                <a href="{{ route('dashboard') }}" wire:navigate>
                    <span>
                        <x-icon-o-home class="w-5 h-5 stroke-current" />
                    </span>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <ul class="menu menu-sm lg:menu-md px-4 py-0 gap-2">
            <li></li>
            <li class="menu-title flex flex-row gap-4">
                <span>Master Data</span>
            </li>
            <li>
                <a href="{{ route('sekolah.all') }}">
                    <x-icon-o-home-modern class="w-5 h-5 stroke-current" />
                    <span>Sekolah</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gtk.all') }}">
                    <x-icon-o-user-group class="w-5 h-5 stroke-current" />
                    <span>GTK</span>
                </a>
            </li>
            </li>
        </ul>

        <ul class="menu menu-sm lg:menu-md px-4 py-0 gap-2">
            <li></li>
            <li class="menu-title flex flex-row gap-4">
                <span>Manage Apps</span>
            </li>
            <li>
                <a href="#">
                    <x-icon-o-adjustments-horizontal class="w-5 h-5 stroke-current" />
                    <span>Settings Application</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.all') }}">
                    <x-icon-o-user-group class="w-5 h-5 stroke-current" />
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="#"><x-icon-o-key class="w-5 h-5 stroke-current" /><span>Roles & Permissions</span></a>
            </li>
            </li>
        </ul>

        <ul class="menu menu-sm lg:menu-md px-4 py-0 gap-2"> </ul>
        <div
            class="bg-base-100 pointer-events-none sticky bottom-0 flex h-40 [mask-image:linear-gradient(transparent,#000000)]">
        </div>
    </div>
</aside>
