<div class="flex justify-between">
    <h2 class="text-2xl leading-7 text-gray-900">
        {{ $movie->original_title }}
    </h2>
    
    @if($fiche->updated_at)
    <div class="mt-3 text-xs tracking-tight text-gray-600 align-baseline">
        Modified on {{ $fiche->updated_at->format('d F Y') }} by {{ $fiche->updatedBy->name }}
    </div>
    @endif
</div>
