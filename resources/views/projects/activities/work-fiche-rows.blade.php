@foreach ($fiches as $fiche)

    <x-table.cell class="text-center font-md tracking-tight">
        {{ $fiche->media->title }}
    </x-table.cell>
    <x-table.cell class="text-center font-md tracking-tight">
        {{ $fiche->media->genre->name }}
    </x-table.cell>
    <x-table.cell class="text-center font-md tracking-tight">
        {{ $fiche->media->grantable->year_of_copyright }}
    </x-table.cell>
    <x-table.cell class="text-center font-md tracking-tight">
        {{ $fiche->media->grantable->id }}
    </x-table.cell>
    <x-table.cell class="text-center space-x-2">
        <a href="{{ url(
                sprintf('dossiers/%d/activities/%d/fiches/dist/%d', $dossier->id, $activity->id, $fiche->id)
            )  }}"
            class="cursor-pointer text-purple-600">
            Edit
        </a>
        <a class="ml-8 cursor-pointer text-red-600">Delete</a>
    </x-table.cell>

@endforeach
