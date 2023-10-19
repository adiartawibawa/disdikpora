<div class="card w-full bg-base-100 shadow-xl relative overflow-hidden">
    <img class="absolute w-56 left-1/3 opacity-75" src="{{ $bgIllustration }}" alt="">
    <div class="card-body relative">
        <a href="#" target="_blank">
            <h2 class="text-4xl font-bold">{{ $data->count() }}</h2>
            <p class="mt-2 font-sans text-base font-medium text-gray-500">
                {{ $title }}
            </p>
        </a>
    </div>
</div>
