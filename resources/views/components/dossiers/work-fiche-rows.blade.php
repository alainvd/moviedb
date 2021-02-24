@foreach ($fiches as $fiche)

<x-table.row>
    <x-table.cell class="tracking-tight text-center font-md">
        {{ $fiche->movie->original_title }}
    </x-table.cell>
    <x-table.cell class="tracking-tight text-center font-md">
        {{ $fiche->movie->genre->name }}
    </x-table.cell>
    <x-table.cell class="tracking-tight text-center font-md">
        {{ $fiche->movie->year_of_copyright }}
    </x-table.cell>
    <x-table.cell class="tracking-tight text-center font-md">
        {{ $fiche->movie->id }}
    </x-table.cell>
    <x-table.cell class="space-x-2 text-center">
        <a href="{{ url(
                sprintf('dossiers/%s/activities/%d/fiches/%d', $dossier->project_ref_id, $activity->id, $fiche->id)
            )  }}"
            class="text-purple-600 cursor-pointer">
            Edit
        </a>
        <a class="ml-8 text-red-600 cursor-pointer">Delete</a>
    </x-table.cell>
</x-table.row>

@endforeach
