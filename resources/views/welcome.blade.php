@push('styles')
    {{--  --}}
@endpush

<x-front-layout>
    <section class="relative">
        <div class="absolute w-full bg-center bg-cover place-items-center h-[38rem] z-10">
            <div class="flex items-center justify-center w-full h-full bg-gray-900/40">
                <div class="flex flex-col items-center mx-auto text-center">
                    <h1 class="text-4xl font-semibold text-white uppercase md:text-6xl">
                        Sistem Informasi Sekolah
                    </h1>
                    <p class="mt-6 text-lg leading-5 text-white">Dinas Pendidikan Kepemudaan dan Olahraga Kabupaten
                        Badung</p>

                    <a href="#about" class="mt-8 cursor-pointer animate-bounce">
                        <svg width="53" height="53" viewBox="0 0 53 53" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="27" cy="26" r="18" stroke="white" stroke-width="2" />
                            <path
                                d="M22.41 23.2875L27 27.8675L31.59 23.2875L33 24.6975L27 30.6975L21 24.6975L22.41 23.2875Z"
                                fill="white" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-full h-[38rem] overflow-hidden z-0">
            @livewire(Pages\Peta\PetaSekolah::class)
        </div>
    </section>

    <section class="container px-6 py-8 mx-auto lg:py-16 " id="about">
        <div class="lg:flex lg:items-center lg:-mx-4">
            <div class="lg:w-1/2 lg:px-4">
                <h3 class="text-xl font-medium text-gray-800 md:text-2xl lg:text-3xl">
                    Empowering Education Through
                    Spatial Insight: Mapping Futures
                </h3>
                <p class="mt-6 text-gray-500 ">
                    Setiap titik koordinat
                    mengungkapkan cerita, setiap jalur membuka peluang, dan setiap sekolah adalah pangkalan
                    perubahan. Melalui teknologi dan semangat belajar, kami membentuk fondasi untuk masa depan
                    pendidikan yang lebih cerah. Ruang dan tempat bukan lagi sekadar peta, tetapi merupakan dunia di
                    mana pengetahuan dan inovasi berpadu untuk menciptakan pendidikan inklusif dan progresif.
                </p>
            </div>

            <div class="mt-8 lg:w-1/2 lg:px-4 lg:mt-0">
                <iframe class="object-cover w-full rounded-xl h-96" src="https://www.youtube.com/embed/aqvjzO4MuK8"
                    title="Profil dan Potensi Kabupaten Badung, Bali" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                    alt="Video Profil Dinas Pendidikan, Kepemudaan dan Olah Raga Kabupaten Badung"></iframe>
            </div>
        </div>
    </section>

    @livewire('pages.layanans.show-layanan')

    <section class="container px-6 py-8 mx-auto lg:py-16">
        <h3 class="text-xl font-medium text-gray-800 md:text-2xl lg:text-3xl ">Sekolah Kami</h3>

        <div class="flex items-center py-6 mt-4 -mx-2 overflow-x-auto whitespace-nowrap">
            <button
                class=" inline-flex px-4 mx-2 focus:outline-none  items-center py-0.5 text-white bg-red-500 hover:bg-red-400 duration-300 transition-colors rounded-2xl">Semua</button>
            <button
                class=" inline-flex px-4 mx-2 duration-300 transition-colors hover:bg-red-500/70 hover:text-white text-gray-500 focus:outline-none py-0.5 cursor-pointer rounded-2xl">TK/PAUD</button>
            <button
                class=" inline-flex px-4 mx-2 duration-300 transition-colors hover:bg-red-500/70 hover:text-white text-gray-500 focus:outline-none py-0.5 cursor-pointer rounded-2xl">SD</button>
            <button
                class=" inline-flex px-4 mx-2 duration-300 transition-colors hover:bg-red-500/70 hover:text-white text-gray-500 focus:outline-none py-0.5 cursor-pointer rounded-2xl">SMP</button>
        </div>

        <div class="grid grid-cols-1 gap-10 mt-10 md:grid-cols-2 lg:grid-cols-3 ">
            <a href="#" class="transition-all duration-500 lg:col-span-2 hover:scale-105">
                <img class="object-cover object-top w-full rounded-lg shadow-md shadow-gray-200 h-80 xl:h-96"
                    src="https://www.dancow.co.id/sites/default/files/2023-06/Lingkungan%20Sekolah%20Ramah%20Anak%2C%20Ini%20Pengertian%20dan%20Manfaatnya.jpg"
                    alt="">
            </a>

            <a href="#" class="transition-all duration-500 hover:scale-105">
                <img class="object-cover object-top w-full rounded-lg shadow-md shadow-gray-200 h-80 xl:h-96 "
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/37/Sekolah_Dasar_Satu_Bangsa_Harmoni_Batam.jpg/640px-Sekolah_Dasar_Satu_Bangsa_Harmoni_Batam.jpg"
                    alt="">
            </a>

            <a href="#" class="transition-all duration-500 hover:scale-105">
                <img class="object-cover object-top w-full rounded-lg shadow-md shadow-gray-200 h-80 xl:h-96"
                    src="https://sekolahsantomarkus.sch.id/wp-content/uploads/2023/08/IMG20230814073516-1-1400x510.jpg"
                    alt="">
            </a>

            <a href="#" class="transition-all duration-500 lg:col-span-2 hover:scale-105">
                <img class="object-cover object-top w-full rounded-lg shadow-md shadow-gray-200 h-80 xl:h-96"
                    src="https://akcdn.detik.net.id/visual/2022/07/18/semangat-siswa-sambut-hari-pertama-masuk-sekolah-2_169.jpeg?w=650"
                    alt="">
            </a>

            <a href="#" class="transition-all duration-500 lg:col-span-2 hover:scale-105">
                <img class="object-cover object-top w-full rounded-lg shadow-md shadow-gray-200 h-80 xl:h-96"
                    src="https://alif.id/wp-content/uploads/2022/04/ilustrasi-anak-sekolah.webp" alt="">
            </a>

            <a href="#" class="transition-all duration-500 hover:scale-105">
                <img class="object-cover object-top w-full rounded-lg shadow-md shadow-gray-200 h-80 xl:h-96"
                    src="https://cdn1.katadata.co.id/media/images/thumb/2023/07/03/Kapan_Masuk_Sekolah_Tahun_AJaran_2023-2023_07_03-13_20_35_8c54700e6d9695f50b5da348109bdf9d_960x640_thumb.jpeg"
                    alt="">
            </a>
        </div>
    </section>

    <section class="bg-red-50/50">
        <div class="container px-6 py-8 mx-auto lg:py-16">
            <h3 class="text-xl font-medium text-gray-800 md:text-2xl lg:text-3xl ">Recent Blog Posts</h3>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-10 md:grid-cols-2 xl:grid-cols-3">
                <div>
                    <div class="relative">
                        <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80"
                            src="https://disdikpora.badungkab.go.id/storage/disdikpora/image/1.jpeg%203%20sading.jpeg"
                            alt="">

                        <div class="absolute bottom-0 flex p-3 bg-white ">
                            <img class="object-cover object-center w-10 h-10 rounded-full"
                                src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Lambang_Kabupaten_Badung.png"
                                alt="">

                            <div class="mx-4">
                                <h1 class="text-sm text-gray-700">Admin</h1>
                                <p class="text-sm text-gray-500">Disdikpora Kabupaten Badung</p>
                            </div>
                        </div>
                    </div>

                    <h1 class="mt-6 text-xl font-semibold text-gray-800">Sosialisasi Jaksa Masuk Sekolah ( Sekolah
                        Dasar )
                    </h1>

                    <hr class="w-32 my-6 text-red-500">

                    <p class="text-sm text-gray-500">
                        {{ Str::limit(
                            'Sosialisasi Jaksa Masuk Sekolah oleh Kejaksaan Negeri Badung di dampingi Staf Bidang Pendidikan Sekolah Dasar Disdikpora Kab. Badung, yang bertempat di SD Negeri 3 SADING dan SD Negeri 4 SADING Kec. Mengwi Kab. Badung. Materi dari sosialisasi/penyuluhan, mengenai Hukum sebab akibat dari penyalah gunaan GADGET ( Sisoal Media ) kepada siswa-siswi di kalangan Sekolah Dasar.',
                            300,
                        ) }}
                    </p>

                    <a href="#" class="inline-block mt-4 text-red-500 underline hover:text-red-400">Read
                        more</a>
                </div>

                <div>
                    <div class="relative">
                        <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80"
                            src="https://disdikpora.badungkab.go.id/storage/disdikpora/image/WhatsApp%20Image%202022-12-21%20at%2015.10.49.jpeg"
                            alt="">

                        <div class="absolute bottom-0 flex p-3 bg-white ">
                            <img class="object-cover object-center w-10 h-10 rounded-full"
                                src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Lambang_Kabupaten_Badung.png"
                                alt="">

                            <div class="mx-4">
                                <h1 class="text-sm text-gray-700">Admin</h1>
                                <p class="text-sm text-gray-500">Disdikpora Kabupaten Badung</p>
                            </div>
                        </div>
                    </div>

                    <h1 class="mt-6 text-xl font-semibold text-gray-800">Pelepasan Mahasiswa Peserta Program Kampus
                        Mengajar Angkatan 4
                    </h1>

                    <hr class="w-32 my-6 text-red-500">

                    <p class="text-sm text-gray-500">
                        {{ Str::limit('Rabu, 21 Desember 2022 di Dinas Pendidikan, Kepemudaan dan Olah Raga. Kepala Bidang Pendidikan Dasar Ibu Rai Twistyanti Raharja, ST.MT, Melaksanakan Pelepasan mahasiswa peserta program Kampus Mengajar angkatan 4 sekaligus sharing session atas praktik baik yang sudah dilakukan di SD 2 Bongkasa, SD 3 Belok, dan SD 4 Belok.', 300) }}
                    </p>

                    <a href="#" class="inline-block mt-4 text-red-500 underline hover:text-red-400">Read
                        more</a>
                </div>

                <div>
                    <div class="relative">
                        <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80"
                            src="https://disdikpora.badungkab.go.id/storage/disdikpora/image/aa.jpg" alt="">

                        <div class="absolute bottom-0 flex p-3 bg-white ">
                            <img class="object-cover object-center w-10 h-10 rounded-full"
                                src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Lambang_Kabupaten_Badung.png"
                                alt="">

                            <div class="mx-4">
                                <h1 class="text-sm text-gray-700">Admin</h1>
                                <p class="text-sm text-gray-500">Disdikpora Kabupaten Badung</p>
                            </div>
                        </div>
                    </div>

                    <h1 class="mt-6 text-xl font-semibold text-gray-800">Kegiatan Sosialisasi Pendampingan Belajar
                        Bagi Siswa Berkebutuhan Khusus Bagi Kepala Sekolah di Kabupaten Badung</h1>

                    <hr class="w-32 my-6 text-red-500">

                    <p class="text-sm text-gray-500">
                        {{ Str::limit('IBU Rai Twistyanti Raharja,ST.MT selaku Kepala Bidang Pendidikan Sekolah Dasar DISDIKPORA Kabupaten Badung membuka Kegiatan Sosialisasi Pendampingan Belajar Bagi Siswa Berkebutuhan Khusus Bagi Kepala Sekolah di Kabupaten Badung di SMAN 1 Kuta Utara, Selasa 10 Januari 2023', 300) }}
                    </p>

                    <a href="#" class="inline-block mt-4 text-red-500 underline hover:text-red-400">Read
                        more</a>
                </div>
            </div>
        </div>
    </section>
</x-front-layout>

@push('scripts')
    {{--  --}}
@endpush
