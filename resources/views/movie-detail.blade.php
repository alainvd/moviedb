<x-layout>
    <div class="pt-2 pb-6 md:py-6">

        @if (isset($movie_id))
            @livewire('movie-detail-form', ['movie_id' => $movie_id])
        @else
            @livewire('movie-detail-form')
        @endif

    </div>
</x-layout>
