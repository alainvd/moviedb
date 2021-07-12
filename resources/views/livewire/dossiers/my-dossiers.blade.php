<div class="mb-64">
    <div class="flex items-center justify-between my-4">
        <h3 class="text-xl tracking-wider text-gray-800 text-bold">
            Here are your existing technical dossiers as recorded in Creative Europe MEDIA Database
        </h3>
        <label class="block font-medium text-indigo-600">
            <input class="mr-2" type="checkbox" wire:model="showClosed">
            <span class="text-md">
                Show closed calls
            </span>
        </label>
    </div>

    <x-table class="mb-4 dossiers-list">
        <x-slot name="head">
            <x-table.heading>CALL</x-table.heading>
            <x-table.heading>YEAR</x-table.heading>
            <x-table.heading>DRAFT PROPOSAL ID</x-table.heading>
            <x-table.heading>LAST UPDATE</x-table.heading>
            <x-table.heading>CALL STATUS</x-table.heading>
            <x-table.heading>DOSSIER STATUS</x-table.heading>
            <x-table.heading>&nbsp;</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @forelse ($dossiers as $dossier)
            <x-table.row>
                <x-table.cell class="text-center">
                    {{ $dossier->action->name }}
                </x-table.cell>
                <x-table.cell class="text-center">
                    {{ $dossier->call->published_at->format('Y') }}
                </x-table.cell>
                <x-table.cell class="text-center">
                    {{ $dossier->project_ref_id }}
                </x-table.cell>
                <x-table.cell class="text-center">
                    {{ $dossier->updated_at->format('d.m.Y') }}
                </x-table.cell>
                <x-table.cell class="text-center uppercase">
                    {{ $dossier->call->status }}
                </x-table.cell>
                <x-table.cell class="text-center uppercase {{ $dossier->status->name === 'Draft' ? 'text-red-600' : '' }}">
                    {{ $dossier->public_status }}
                </x-table.cell>
                <x-table.cell class="text-center">
                    <a href="{{ route('dossiers.show', $dossier) }}" class="text-indigo-600 cursor-pointer hover:text-indigo-900">
                        {{ $dossier->call->status === 'open' ? 'Edit' : 'View'}}
                    </a>
                    @if($dossier->status->id !== 1)
                    <a href="{{ url('dossiers/'.$dossier->project_ref_id.'/download-full')  }}" class="ml-8 text-indigo-600 cursor-pointer hover:text-indigo-900">
                        Download
                    </a>
                    @endif
                </x-table.cell>
            </x-table.row>
            @empty
            <x-table.row>
                <x-table.cell class="text-center" colspan="100%">No dossiers yet</x-table.cell>
            </x-table.row>
            @endforelse
        </x-slot>
    </x-table>
</div>
