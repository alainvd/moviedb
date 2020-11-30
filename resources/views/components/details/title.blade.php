<div class="flex justify-between">
    <h2 class="text-2xl leading-7 text-gray-900">
        MDB{{ $this->movie_original['year_of_copyright'] }}/{{ $movie->id }} - {{ $this->movie_original['original_title'] }}
    </h2>

    @if($this->movie_original['updated_at'])
    <div class="text-xs tracking-tight text-gray-600 align-baseline mt-3">
        Modified on {{ \Illuminate\Support\Carbon::parse($this->movie_original['updated_at'])->format('d F Y') }} by John Smith
    </div>
    @endif
</div>
