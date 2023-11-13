<div class="flex">
    <div class="mx-auto px-6 xl:container md:px-12">
        <div class="mb-16 md:w-2/3 lg:w-1/2">
            <h2 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white md:text-4xl">Daftar Layanan Kami</h2>
            <p class="text-gray-600 dark:text-gray-300">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum eaque reiciendis, obcaecati ipsam quo
                modi dolorum quisquam esse doloremque eveniet.
            </p>
        </div>
        <div class="grid gap-6 px-4 sm:grid-cols-2 sm:px-0 md:grid-cols-3">
            @forelse ($layanans as $item)
                <div class="group relative space-y-6 overflow-hidden rounded-3xl">
                    <img class="ransition mx-auto h-48 w-full object-cover object-top grayscale duration-500 group-hover:scale-105 group-hover:grayscale-0"
                        src="https://img.freepik.com/free-vector/male-hand-holding-folder-with-documents-flat-vector-illustration-businessman-holding-red-file-important-business-real-estate-documents-stationery-application-meeting-concept_74855-24910.jpg?w=740&t=st=1699846955~exp=1699847555~hmac=3e5e3ebda6cc94790ba572f35072976f93d278b6dddb985096ff8b942b2073a7"
                        alt="{{ $item->name }}" loading="lazy" width="640" height="805" />
                    <div
                        class="absolute inset-x-0 bottom-0 mt-auto h-max translate-y-24 bg-gray-800 px-8 py-6 transition duration-300 ease-in-out group-hover:translate-y-0 dark:bg-white">
                        <div>
                            <h4 class="text-xl font-semibold text-white dark:text-gray-700">{{ $item->name }}</h4>
                            <span class="block text-sm text-gray-500">
                                Estimasi layanan : {{ $item->estimasi }} Hari
                            </span>
                            {{-- <span class="block text-sm text-gray-500">
                                {{ Str::limit($item->desc, 50, '...') }}
                            </span> --}}
                        </div>
                        <p wire:click="$dispatch('openModal',{component:'welcome.panduan-layanan', arguments:{layanan: '{{ $item->id }}'}} )"
                            class="cursor-pointer mt-8 text-gray-300 dark:text-gray-600 underline">Detail</p>
                    </div>
                </div>
            @empty
                <p>Belum ada layanan yang tersedia</p>
            @endforelse
        </div>
    </div>
</div>
