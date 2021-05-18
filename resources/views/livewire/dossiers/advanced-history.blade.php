<div class="mt-8 mb-16">

    @if (Auth::user()->can('view advanced history'))
        <a href="{{ $backUrl }}" class="mb-4 outline-none text-blue-500 text-md font-normal tracking-wide flex align-middle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg>
            Go back
        </a>
    @endif

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
                        {{ $log['user'] ? $log['user']->email : '' }}
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
