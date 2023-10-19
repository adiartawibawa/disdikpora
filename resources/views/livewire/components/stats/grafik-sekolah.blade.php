<div class="card w-full bg-base-100 shadow-xl relative overflow-hidden h-52">
    <div class="absolute w-56  h-full">
        <livewire:livewire-pie-chart key="{{ $pieChartModel->reactiveKey() }}" :pie-chart-model="$pieChartModel" />
    </div>
    <div class="card-body relative left-[50%]">
        <h2 class="text-xl md:text-4xl font-bold">Info Grafis</h2>
        <p class="mt-2 font-sans text-sm md:text-base font-medium text-gray-500">
            Satuan Pendidikan
        </p>
    </div>
</div>
