<div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- {{ dd($this->form) }} --}}
            @isset($this->form)
                {{ $this->form }}
            @endisset
        </div>
    </div>
</div>
