<div class="flex justify-between">
    <h2 class="text-2xl leading-7 text-gray-900">
        DIST {{$movie->year_of_copyright }}/{{ $movie->id }}/
        - {{ $movie->original_title }}
    </h2>

    @if($fiche->updated_at)
    <div class="text-xs tracking-tight text-gray-600 align-baseline mt-3">
        Modified on {{ $fiche->updated_at->format('d F Y') }} by John Smith
    </div>
    @endif
</div>
