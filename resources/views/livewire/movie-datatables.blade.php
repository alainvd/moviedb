<x-layout :title="$title">
    <x-slot name="slotAbove">
        <div class="mt-8">
            @include('livewire.dashboard.dials')
        </div>
    </x-slot>
    <div class="mt-8">
        <div class="w-full">
            <livewire:movie-datatables searchable="original_title" exportable />
        </div>

    </div>

</x-layout>
