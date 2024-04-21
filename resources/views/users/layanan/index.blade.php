<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Layanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <section class="bg-white dark:bg-gray-900 rounded-lg">
                <div class="container px-6 py-12 mx-auto">
                    <h1 class="text-2xl font-semibold text-gray-800 lg:text-3xl dark:text-white">
                        Layanan Kami
                    </h1>

                    <div class="mt-8 space-y-8 lg:mt-12">
                        <div x-data="{ open: false }" class="p-8 bg-gray-100 rounded-lg dark:bg-gray-800">
                            <dt @click="open = !open">
                                <button class="flex items-center justify-between w-full">
                                    <h1 class="font-semibold text-gray-700 dark:text-white">
                                        Lorem, ipsum dolor sit amet!
                                        ?</h1>

                                    <span class="rounded-full"
                                        :class="open ? 'bg-gray-200 text-gray-400' : 'bg-red-500 text-white'">
                                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18 12H6" />
                                        </svg>
                                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </span>
                                </button>
                            </dt>

                            <dd class="p-3 space-y-4" x-show="open"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-y-6"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-6">
                                <p class="mt-6 text-sm text-gray-500 dark:text-gray-300">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas eaque nobis,
                                    fugit
                                    odit omnis fugiat deleniti animi ab maxime cum laboriosam recusandae facere dolorum
                                    veniam quia pariatur obcaecati illo ducimus?
                                </p>
                            </dd>

                        </div>
                    </div>
                    <div class="mt-4 space-y-8 lg:mt-6">
                        <div x-data="{ open: false }" class="p-8 bg-gray-100 rounded-lg dark:bg-gray-800">
                            <dt @click="open = !open">
                                <button class="flex items-center justify-between w-full">
                                    <h1 class="font-semibold text-gray-700 dark:text-white">
                                        Lorem, ipsum dolor sit amet!
                                        ?</h1>

                                    <span class="rounded-full"
                                        :class="open ? 'bg-gray-200 text-gray-400' : 'bg-red-500 text-white'">
                                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18 12H6" />
                                        </svg>
                                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </span>
                                </button>
                            </dt>

                            <dd class="p-3 space-y-4" x-show="open"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-y-6"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-6">
                                <p class="mt-6 text-sm text-gray-500 dark:text-gray-300">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas eaque nobis,
                                    fugit
                                    odit omnis fugiat deleniti animi ab maxime cum laboriosam recusandae facere dolorum
                                    veniam quia pariatur obcaecati illo ducimus?
                                </p>
                            </dd>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
