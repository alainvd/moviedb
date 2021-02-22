<div class="my-8">
    <input type="hidden" name="previous_works" wire:model="current">
    <h3 class="text-lg leading-tight font-normal my-4">
        Audiovisual Work - Development - Recent work / previous experience
    </h3>
    <x-table class="{{ $errors->has('previous_works') ? 'border border-red-500' : '' }}">
        <x-slot name="head">
            <x-table.heading>TITLE</x-table.heading>
            <x-table.heading>GENRE</x-table.heading>
            <x-table.heading>PRODUCTION YEAR</x-table.heading>
            <x-table.heading>FILM ID</x-table.heading>
            <x-table.heading>&nbsp;</x-table.heading>
        </x-slot>

        <x-slot name="body">

            @if ($results->count())

                <x-dossiers.work-fiche-rows
                    :type="'previous'"
                    :fiches="$results"
                    :dossier="$dossier"
                    :activity="$activity"></x-dossiers.work-fiche-rows>

            @else

            <x-table.row>
                <x-table.cell class="text-center" colspan="5">No movies yet</x-table.cell>
            </x-table.row>

            @endif

        </x-slot>
    </x-table>

    @error('previous_works')
        <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
    @enderror

    <div class="mt-5 text-right">
        <x-anchors.secondary
            :url="route('dev-previous', compact('dossier', 'activity'))"
            :disabled="$isAddDisabled">
            Add
        </x-anchors.secondary>
    </div>

    <x-modal.confirmation wire:model.defer="showDeleteModal">
        <x-slot name="title">Remove Previous Work</x-slot>

        <x-slot name="content">
            <div class="py-8 text-xl">
                Are you sure you want to remove this previous work from the dossier?
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end items-center space-x-3">
                <x-button.primary wire:click="delete">Yes</x-button>

                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button>
            </div>
        </x-slot>
    </x-modal.confirmation>
</div>
