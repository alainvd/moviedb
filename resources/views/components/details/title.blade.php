<div class="flex justify-between">
    <h2 class="text-2xl leading-7 text-gray-900">
        MDB{{ $movie->year_of_copyright }}/{{ $movie->id }} - {{ $movie->original_title }}
    </h2>

    @if($movie->updated_at)

    <div class="text-xs tracking-tight text-gray-600 align-baseline mt-3">
        Modified on {{-- $movie->updated_at->format('d F Y') --}} by John Smith
    </div>

    @endif
</div>
