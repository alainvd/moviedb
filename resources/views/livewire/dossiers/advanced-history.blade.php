<div class="mt-8">
    <x-table>
        <x-slot name="head">
            <x-table.heading>Description</x-table.heading>
            <x-table.heading>User</x-table.heading>
            <x-table.heading>Date</x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading>&nbsp;</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach ($logs as $log)
                <x-table.row>
                    <x-table.cell class="text-center">
                        {{ $log['description'] }}
                    </x-table.cell>
                    <x-table.cell class="text-center">
                        {{ $log['user']->email }}
                    </x-table.cell>
                    <x-table.cell class="text-center">
                        {{ $log['log_date']->format('d.m.Y H:i') }}
                    </x-table.cell>
                    <x-table.cell class="text-center">
                        {{ $log['status'] }}
                    </x-table.cell>
                    <x-table.cell class="text-center">
                        <a class="text-purple-600 cursor-pointer print:hidden"
                            wire:click.prevent="toggleView({{ $log['id'] }})">
                            View changes
                        </a>
                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>

    <x-advanced-history-modal wire:model="showViewChanges" :changes="$changes"></x-advanced-history-modal>
</div>
