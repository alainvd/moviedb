@foreach ($admissions as $admission)

    <x-table.row>
        <x-table.cell class="tracking-tight text-center font-md">
            {{ !empty($admission->fiche) ? $admission->fiche->movie->original_title : '' }}
        </x-table.cell>
        <x-table.cell class="tracking-tight text-center font-md">
            {{ !empty($admission->admissionsTable->country_id) ? $countriesById[$admission->admissionsTable->country_id]['name'] : '' }}
        </x-table.cell>
        <x-table.cell class="tracking-tight text-center font-md">
            {{ $admission->admissionsTable->year }}
        </x-table.cell>
        <x-table.cell class="tracking-tight text-center font-md">
            {{ $admission->certified_admissions }}
        </x-table.cell>
        @if(empty($print))
        <x-table.cell class="space-x-2 text-center">
            <a href="{{ route('admission', [$dossier->project_ref_id, $admission->admissionsTable->id, $admission->id]) }}"
                class="text-purple-600 cursor-pointer print:hidden">
                Edit
            </a>
            <a class="ml-8 text-red-600 cursor-pointer print:hidden" wire:click="showDelete({{ $admission->id }})">
                Remove
            </a>
        </x-table.cell>
        @endif
    </x-table.row>

@endforeach
