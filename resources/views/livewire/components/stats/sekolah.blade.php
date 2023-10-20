<div class="card w-full bg-base-100 shadow-xl relative overflow-hidden h-52">
    <img class="absolute w-56 left-[50%] md:left-[55%] opacity-75"
        src="https://img.freepik.com/free-vector/school-building-illustration_138676-2399.jpg?w=740&t=st=1697723651~exp=1697724251~hmac=b0fbb6ea07b41805202a0b0fbd24291a6ca42da05c66c1bffbe50e557996116f"
        alt="">
    <div class="card-body relative">
        <h2 class="text-4xl font-bold">{{ $sekolah->count() }}</h2>
        <p class="mt-2 font-sans text-base font-medium text-gray-500">
            Satuan Pendidikan
        </p>
        <div class="grid grid-cols-2 col-span-2 gap-2 w-[60%] mt-4 ">
            @foreach ($countStatus as $key => $value)
                <div class="font-sans text-base font-medium text-gray-700 hover:underline hover:text-primary">
                    <a href="#">
                        {{ Str::upper($key) }}
                        <span> : {{ $value }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
