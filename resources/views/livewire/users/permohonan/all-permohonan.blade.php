<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permohonan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <section class="bg-white dark:bg-gray-900 rounded-lg">
                <div class="container px-6 py-12 mx-auto">
                    <h1 class="text-2xl font-semibold text-gray-800 lg:text-3xl dark:text-white">
                        Permohonan Saya
                    </h1>

                    @foreach ($permohonans as $item)
                        <div class="mt-4 space-y-8 lg:mt-6">
                            <div x-data="{ open: false }" class="p-8 bg-gray-100 rounded-lg dark:bg-gray-800">
                                <dt @click="open = !open">
                                    <button class="flex items-center justify-between w-full">
                                        <h1 class="font-semibold text-gray-700">
                                            Permohonan {{ $item->layanan->nama }}
                                        </h1>

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

                                    <hr class="mt-4 border-gray-200">
                                    <div class="mt-8 -my-6">

                                        <div class="text-gray-700 font-bold">Riwayat Permohonan</div>
                                        @foreach ($item->status as $status)
                                            <!-- Item #1 -->
                                            <div class="relative pl-8 sm:pl-32 py-6 group">
                                                <!-- Purple label -->
                                                <div
                                                    class="font-caveat font-medium text-2xl text-indigo-500 mb-1 sm:mb-0">
                                                    {{ $status->status_text }}
                                                </div>
                                                <!-- Vertical line (::before) ~ Date ~ Title ~ Circle marker (::after) -->
                                                <div
                                                    class="flex flex-col sm:flex-row items-start mb-1 group-last:before:hidden before:absolute before:left-2 sm:before:left-0 before:h-full before:px-px before:bg-slate-300 sm:before:ml-[6.5rem] before:self-start before:-translate-x-1/2 before:translate-y-3 after:absolute after:left-2 sm:after:left-0 after:w-2 after:h-2 after:bg-indigo-600 after:border-4 after:box-content after:border-slate-50 after:rounded-full sm:after:ml-[6.5rem] after:-translate-x-1/2 after:translate-y-1.5">
                                                    <time title="dibuat"
                                                        class="sm:absolute left-0 translate-y-0.5 inline-flex items-center justify-center text-xs font-semibold uppercase w-20 h-6 mb-3 sm:mb-0 text-emerald-600 bg-emerald-100 rounded-full">
                                                        {{ $status->created_at_month }}
                                                    </time>
                                                    <div
                                                        class="text-xl font-bold inline-flex items-center justify-center text-slate-900">
                                                        Permohonan Layanan telah {{ $status->status_text }}
                                                        <span class="text-xs text-gray-500 ml-1">
                                                            [ {{ $status->created_at }} ]</span>
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="text-slate-500">
                                                    {{ $status->note }}
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </dd>

                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
