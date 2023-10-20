<div class="card w-full bg-base-100 shadow-xl relative overflow-hidden h-52">
    <img class="absolute w-56 left-[50%] md:left-[55%] opacity-75"
        src="https://img.freepik.com/free-vector/migratory-movement-abstract-illustration_335657-5636.jpg?w=740&t=st=1697726260~exp=1697726860~hmac=d904dce8afced6a34bcf96cbc335c1249ed986523021607d9798b17e66d74f0e"
        alt="">
    <div class="card-body relative">
        <h2 class="text-4xl font-bold"><a href="#">Peta Sebaran</a></h2>
        <p class="mt-2 font-sans text-base font-medium text-gray-500">
            Satuan Pendidikan
        </p>
        <div class="grid grid-cols-3 col-span-3 gap-2 w-[80%] mt-2 ">
            @foreach ($sekolahByDistrict as $item => $value)
                <div class="font-sans text-xs font-medium text-gray-700 hover:underline hover:text-primary">
                    <a href="#">
                        {{ $item }}
                        <span> : {{ $value }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
