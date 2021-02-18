@foreach ($fiches as $fiche)

    @if ($type === 'current')
        <x-table.row>
            <x-table.cell class="text-center font-md tracking-tight">
                {{ $fiche->movie->original_title }}
            </x-table.cell>
            <x-table.cell class="text-center font-md tracking-tight">
                {{ $fiche->movie->genre->name }}
            </x-table.cell>
            <x-table.cell class="text-center font-md tracking-tight">
                {{ $fiche->movie->film_type }}
            </x-table.cell>
            <x-table.cell class="text-center font-md tracking-tight">
                {{ $fiche->movie->total_budget_euro }} &nbsp; EURO
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
    @else
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
    @endif

@endforeach
