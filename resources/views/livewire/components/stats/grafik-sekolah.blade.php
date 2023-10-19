<div class="card w-full bg-base-100 shadow-xl">
    <div class="card-body">
        <div class="card-title">
            Data Berdasarkan Jenjang
        </div>
        <div class="w-full h-full">
            <livewire:livewire-pie-chart key="{{ $pieChartModel->reactiveKey() }}" :pie-chart-model="$pieChartModel" />
        </div>

    </div>
</div>
