<div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="bg-white w-full rounded-lg px-6 py-8">
                    <h2 class="text-lg md:text-2xl mb-4">{{ $layanan->nama }}</h2>
                    <p class="text-sm text-slate-500 mb-2">{{ $layanan->desc }}</p>
                    <small class="text-sm text-red-500">Estimasi layanan : {{ $layanan->estimasi }} Hari kerja</small>
                </div>
            </div>
            @isset($this->form)
                {{ $this->form }}
            @endisset
        </div>
    </div>
</div>
