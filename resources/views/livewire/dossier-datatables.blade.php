<x-layout :title="$title">
    <x-slot name="slotAbove">
        <div class="mt-8">
            @include('livewire.dashboard.dials')
        </div>
    </x-slot>
    <div class="md:flex mt-8">
        <div class="md:justify-center w-full">
            <div class="w-full">
                <livewire:dossier-datatables searchable="project_ref_id, company" exportable />
            </div>
        </div>

    </div>

</x-layout>
