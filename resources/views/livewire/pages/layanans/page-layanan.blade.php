<div class="w-full">
    <section class="container px-6 py-8 mx-auto lg:py-16">
        <div class="grid grid-cols-1 gap-8 xl:gap-12 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($layanan as $item)
                <div class="flex flex-col items-center justify-center w-full max-w-sm mx-auto">
                    <div class="w-full h-64 bg-gray-300 bg-center bg-cover rounded-lg shadow-md"
                        style="background-image: url('{{ $item->ilustrasi_url }}')">
                    </div>

                    <div class="w-56 -mt-10 overflow-hidden bg-white rounded-lg shadow-lg md:w-64 dark:bg-gray-800">
                        <h3 class="py-2 font-bold tracking-wide text-center text-gray-800 uppercase dark:text-white">
                            {{ $item->nama }}</h3>

                        <div class="flex items-center justify-between px-3 py-2 bg-red-200 dark:bg-gray-700">
                            <button wire:click="openModal"
                                class="font-bold text-gray-800 dark:text-gray-200">panduan</button>
                            <button
                                class="px-2 py-1 text-xs font-semibold text-white uppercase transition-colors duration-300 transform bg-red-800 rounded hover:bg-gray-700 dark:hover:bg-gray-600 focus:bg-gray-700 dark:focus:bg-gray-600 focus:outline-none">
                                Ajukan
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <x-filament::modal sticky-header width="5xl" id="modals">
        <x-slot name="heading">
            Panduan Layanan
        </x-slot>

        <x-slot name="description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe vitae hic voluptatum!
        </x-slot>

        <div>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, ullam ex. Quasi, explicabo cum consequatur
            quidem voluptas voluptatum ducimus, iusto sequi minus, totam odio! Et, suscipit. Sit rerum tempore illo
            laudantium cumque delectus culpa perferendis iste cum labore. Libero doloremque culpa temporibus voluptatum,
            ullam facere laboriosam at asperiores! Repellendus culpa vitae earum explicabo quibusdam aliquid ut
            deserunt, est omnis quam tempora recusandae repellat totam sit in rerum laudantium ab! Quia dicta error
            eaque id pariatur non enim assumenda tempore consequuntur totam aliquam ullam saepe minus adipisci magnam
            quasi nemo, cumque, possimus aperiam soluta dolores. Ea, veniam mollitia commodi voluptatem consequuntur
            tenetur atque animi earum odio labore a modi quam saepe, sit maiores quibusdam voluptates nam corrupti
            voluptatum! Quisquam autem tempora odio repellat. Officiis reiciendis cum similique unde ab reprehenderit
            esse nam, molestias repudiandae dolorem sit nesciunt voluptatibus? Earum dolore tempore praesentium
            molestias iure optio labore? Veniam eveniet incidunt vel reprehenderit, molestiae tempora dolores nulla
            aspernatur ipsa culpa veritatis? Dolore magnam, est atque harum aspernatur unde distinctio sequi vero
            veritatis illo dolor beatae libero inventore animi quam? Vel ad dolor nulla eos totam quaerat accusamus!
            Corporis laudantium facere sequi quaerat nisi dolores? Expedita laudantium aspernatur accusantium sapiente
            quos earum, illo ab.
        </div>

        <x-slot name="footer">
            Modal footer content
        </x-slot>
    </x-filament::modal>
</div>
