<?php

use Livewire\Volt\Component;

new class extends Component {
    public function logout(): void
    {
        auth()
            ->guard('web')
            ->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div
    class="bg-base-100 text-base-content sticky top-0 z-30 flex h-16 w-full justify-center bg-opacity-90 backdrop-blur transition-all duration-100 [transform:translate3d(0,0,0)] shadow-sm">
    <nav class="navbar w-full">
        <div class="flex flex-1 md:gap-1 lg:gap-2">
            <span class="tooltip tooltip-bottom before:text-xs before:content-[attr(data-tip)]" data-tip="Menu">
                <label aria-label="Open menu" for="drawer" class="btn btn-square btn-ghost drawer-button lg:hidden">
                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" class="inline-block h-5 w-5 stroke-current md:h-6 md:w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </span>

            <div class="flex items-center gap-2 lg:hidden">
                <a href="/" aria-current="page" aria-label="Homepage"
                    class="flex-0 btn btn-ghost gap-1 px-2 md:gap-2">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="h-6 w-6 md:h-8 md:w-8" />
                    </a>
                    <div class="font-title inline-flex text-lg md:text-2xl"><span
                            class="lowercase">{{ config('app.name') }}</span> <span
                            class="uppercase text-[#1AD1A5]">UI</span>
                    </div>
                </a>
                <div class="dropdown">
                    <div tabindex="0" class="link link-hover my-8 inline-block font-mono text-xs">1.0.0
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-0 gap-2 pr-5">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src={{ 'https://www.gravatar.com/avatar/' . md5(Auth::user()->email) . '?d=mp' }} />
                    </div>
                </label>

                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-56 gap-2">
                    <div class="p-3" x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name"></div>
                    <li><a href="{{ route('profile') }}" wire:navigate class="py-2">Profile</a></li>
                    <li><a wire:click.prevent="logout" class="py-2 hover:bg-error hover:text-base-100">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
