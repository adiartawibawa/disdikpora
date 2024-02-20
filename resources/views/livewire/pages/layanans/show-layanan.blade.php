<section class="bg-red-50/50" x-data="carouselFilter()">
    <div class="container px-6 py-8 mx-auto lg:py-16">
        <h3 class="text-xl font-medium text-gray-800 md:text-2xl lg:text-3xl ">Layanan Kami</h3>

        <div class="flex items-center justify-center gap-8 py-6 mt-4 xl:gap-12" x-data="carouselFilter()">
            <div class="container grid grid-cols-1">
                <div class="row-start-2 col-start-1" x-show="active == 0"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90">

                    <div class="grid grid-cols-1 grid-rows-1" x-data="carousel()" x-init="init()">
                        <div
                            class="col-start-1 row-start-1 relative z-20 flex items-center justify-center pointer-events-none">

                            @foreach ($layanan as $key => $namaLayanan)
                                <h1 class="absolute text-lg md:text-5xl uppercase font-black tracking-widest"
                                    wire:click="url('/admin')" x-show="active == {{ $key }}"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform translate-y-12"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    x-transition:leave="transition ease-out duration-300"
                                    x-transition:leave-start="opacity-100 transform translate-y-0"
                                    x-transition:leave-end="opacity-0 transform -translate-y-12">
                                    {{ $namaLayanan['nama'] }}
                                </h1>
                            @endforeach

                        </div>


                        <div class="carousel col-start-1 row-start-1" x-ref="carousel">
                            @foreach ($layanan as $item)
                                <div class="mx-4 p-6 flex flex-col justify-center items-center w-3/5 h-full border-2 border-red-400 rounded-xl bg-cover"
                                    style="background-image: url('{{ $item->ilustrasi_url }}')">
                                    <div class="flex justify-center pb-1.5 mt-32">
                                        <a href="#" target="_blank" class="group relative z-10 block text-white">
                                            <div
                                                class="bg-red-500 flex items-center justify-center gap-3 rounded-bl-3xl rounded-tr-3xl px-6 py-4 transition duration-200 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 motion-reduce:transition-none motion-reduce:group-hover:transform-none">
                                                <div>Mulai</div>
                                            </div>
                                            <div
                                                class="group-hover:bg-sky-500 absolute inset-0 -z-10 h-full w-full -translate-x-1.5 translate-y-1.5 rounded-bl-3xl rounded-tr-3xl bg-rose-300 transition duration-300 group-hover:-translate-x-2 group-hover:translate-y-2 motion-reduce:transition-none motion-reduce:group-hover:transform-none">
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    <script>
        function carousel() {
            return {
                active: 0,
                init() {
                    var flkty = new Flickity(this.$refs.carousel, {
                        wrapAround: true
                    });
                    flkty.on('change', i => this.active = i);
                }
            }
        }

        function carouselFilter() {
            return {
                active: 0,
                changeActive(i) {
                    this.active = i;

                    this.$nextTick(() => {
                        let flkty = Flickity.data(this.$el.querySelectorAll('.carousel')[i]);
                        flkty.resize();

                        console.log(flkty);
                    });
                }
            }
        }
    </script>
@endpush
