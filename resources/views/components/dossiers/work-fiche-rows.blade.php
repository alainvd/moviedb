@foreach ($fiches as $fiche)

<x-table.row>
    <x-table.cell class="text-center font-md tracking-tight">
        {{ $fiche->movie->original_title }}
    </x-table.cell>
    <x-table.cell class="text-center font-md tracking-tight">
        {{ $fiche->movie->genre->name }}
    </x-table.cell>
    <x-table.cell class="text-center font-md tracking-tight">
        {{ $fiche->movie->year_of_copyright }}
    </x-table.cell>
    <x-table.cell class="text-center font-md tracking-tight">
        {{ $fiche->movie->id }}
    </x-table.cell>
    <x-table.cell class="text-center space-x-2">
        <a href="{{ route("dev-{$type}", compact('dossier', 'activity', 'fiche'))  }}"
            class="cursor-pointer text-purple-600">
            Edit
        </a>
        <a class="ml-8 cursor-pointer text-red-600" wire:click="showDelete({{ $fiche->id }})">
            Remove
        </a>
    </x-table.cell>
</x-table.row>

@endforeach
