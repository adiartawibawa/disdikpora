<x-app-layout>

    @section('title', 'Dashboard')

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="w-full bg-white">
        {{ __("You're logged in!") }}
    </div>
</x-app-layout>
