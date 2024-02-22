@push('styles')
    {{--  --}}
@endpush

<x-front-layout>
    <section class="container px-6 py-8 mx-auto lg:py-16">
        <div class="lg:flex lg:items-center lg:-mx-4">
            @livewire('pages.layanans.page-layanan')
        </div>
    </section>
</x-front-layout>

@push('scripts')
    {{--  --}}
@endpush
