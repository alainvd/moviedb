<div class="my-8">
    <input type="hidden" name="current_works" wire:model="current">
    <h3 class="my-4 text-lg font-normal leading-tight">
        Audiovisual Work - {{ $dossier->action->name === 'TV' ? 'Production' : 'Development'}} - For grant request
    </h3>
    <x-table class="{{ $errors->has('current_works') ? 'border border-red-500' : '' }}">
        <x-slot name="head">
            <x-table.heading>TITLE</x-table.heading>
            <x-table.heading>GENRE</x-table.heading>
            <x-table.heading>FILM TYPE</x-table.heading>
            <x-table.heading>BUDGET</x-table.heading>
            <x-table.heading>STATUS</x-table.heading>
            @if(empty($print))<x-table.heading>&nbsp;</x-table.heading>@endif
        </x-slot>

        <x-slot name="body">

            @if ($results->count())

                <x-dossiers.work-fiche-rows
                    :type="'current'"
                    :fiches="$results"
                    :dossier="$dossier"
                    :activity="$activity"
                    :print="$print">
                </x-dossiers.work-fiche-rows>

            @else

            <x-table.row>
                <x-table.cell class="text-center" colspan="5">No movies yet</x-table.cell>
            </x-table.row>

            @endif

        </x-slot>
    </x-table>

    @error('current_works')
        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
    @enderror

    @if(empty($print))
    <div class="mt-5 text-right print:hidden">
        <x-anchors.secondary
            :url="$this->url"
            :disabled="$isAddDisabled">
            Add
        </x-anchors.secondary>
    </div>
    @endif

    <x-modal.confirmation wire:model.defer="showDeleteModal">
        <x-slot name="title">Remove Current Work</x-slot>

        <x-slot name="content">
            <div class="py-8 text-xl">
                Are you sure you want to remove this current work from the dossier?
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-end space-x-3">
                <x-button.primary wire:click="delete">Yes</x-button>

                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button>
            </div>
        </x-slot>
    </x-modal.confirmation>
</div>
