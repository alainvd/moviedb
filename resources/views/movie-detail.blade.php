<x-layout>
    <div class="pt-2 pb-6 md:py-6">

        @if (isset($movie_id))
            @livewire($template, ['backoffice' => $backoffice, 'movie_id' => $movie_id])
        @else
            @livewire($template, ['backoffice' => $backoffice])
        @endif

    </div>
</x-layout>
