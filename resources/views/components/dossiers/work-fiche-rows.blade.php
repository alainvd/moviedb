@foreach ($fiches as $fiche)

    @if (in_array($type, ['current', 'short']))
        <x-table.row>
            <x-table.cell class="tracking-tight text-center font-md">
                {{ $fiche->movie->original_title }}
            </x-table.cell>
            <x-table.cell class="tracking-tight text-center font-md">
                {{ $fiche->movie->genre->name }}
            </x-table.cell>
            <x-table.cell class="tracking-tight text-center font-md">
                {{ App\Models\Movie::FILM_TYPES[$fiche->movie->film_type] }}
            </x-table.cell>
            <x-table.cell class="tracking-tight text-center font-md">
                {{ $fiche->movie->total_budget_euro }} &nbsp; EURO
            </x-table.cell>
            <x-table.cell class="tracking-tight text-center font-md uppercase {{ $fiche->status->name === 'Draft' ?  'text-red-600' : '' }}">
                {{ $fiche->status->name }}
            </x-table.cell>
            @if(empty($print))
            <x-table.cell class="space-x-2 text-center">
                <a href="{{ route($dossier->action->name === 'TV' ? "tv-fiche-form" : "dev-current-fiche-form", compact('dossier', 'activity', 'fiche'))  }}"
                    class="text-purple-600 cursor-pointer print:hidden">
                    Edit
                </a>
                <a class="ml-8 text-red-600 cursor-pointer print:hidden" wire:click="showDelete({{ $fiche->id }})">
                    Remove
                </a>
            </x-table.cell>
            @endif
        </x-table.row>
    @else
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
            <x-table.cell class="tracking-tight text-center font-md {{ $fiche->status->name === 'Draft' ?  'text-red-600' : '' }}">
                {{ $fiche->status->name }}
            </x-table.cell>
            @if(empty($print))
            <x-table.cell class="space-x-2 text-center">
                <a href="{{ route("dev-prev-fiche-form", compact('dossier', 'activity', 'fiche'))  }}"
                    class="text-purple-600 cursor-pointer print:hidden">
                    Edit
                </a>
                <a class="ml-8 text-red-600 cursor-pointer print:hidden" wire:click="showDelete({{ $fiche->id }})">
                    Remove
                </a>
            </x-table.cell>
            @endif
        </x-table.row>
    @endif

@endforeach
