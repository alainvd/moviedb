<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="flex-1 min-w-0 flex flex-row justify-between">
        <div>
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9">
                MDB{{ $movie->year_of_copyright }}/{{ $movie->id }} - {{ $movie->original_title }}
            </h2>
        </div>
        <div class="text-gray-600 inline-block align-baseline mt-3">
            Modified on {{-- $movie->updated_at->format('d F Y') --}} by John Smith
        </div>
    </div>
</div>