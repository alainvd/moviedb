<div class="my-16">
    <h3 class="my-4 text-lg font-normal leading-tight">
        Final grant reinvested
    </h3>
    <div class="mb-2">
        Table managed by the monitoring Team
    </div>
    <x-table class="reinvested-list">
        <x-slot name="head">
            <x-table.heading>TITLE</x-table.heading>
            <x-table.heading>TYPE / SUB TYPE</x-table.heading>
            <x-table.heading>GRANT</x-table.heading>
            @if(empty($print))<x-table.heading>&nbsp;</x-table.heading>@endif
        </x-slot>

        <x-slot name="body">

        @forelse ($reinvested as $index => $reinvest)

            <x-table.row>
                <x-table.cell class="text-center ">{!! !empty($reinvest->fiche_id) ? '<a class="text-indigo-600 cursor-pointer hover:text-indigo-900 goto-movie" href="'.route('movie-dist', ['fiche'=>$reinvest->fiche]).'">'.$reinvest->fiche->movie->original_title.'</a>' : '<a class="text-indigo-600 cursor-pointer hover:text-indigo-900 print:hidden select-movie" href="'.route('movie-wizard', ['dossier' => $dossier, 'activity' => 7, 'reinvested' => $reinvest->id]).'">select a movie</a>' !!}</x-table.cell>
                <x-table.cell class="text-center">{{ !empty($reinvest->type_subtype) ? $reinvest->type_subtype : '' }}</x-table.cell>
                <x-table.cell class="text-center">{{ !empty($reinvest->grant) ? euro($reinvest->grant) : '' }}</x-table.cell>
                @if(empty($print))
                <x-table.cell class="space-x-2 text-center">
                    <a wire:click="showAdd({{ $reinvest->id }})" class="text-indigo-600 cursor-pointer hover:text-indigo-900 print:hidden edit-reinvested">
                        Edit
                    </a>
                    <a wire:click="showDelete({{ $reinvest->id }})" class="text-red-600 cursor-pointer hover:text-red-900 print:hidden remove-reinvested">
                        Remove
                    </a>
                </x-table.cell>
                @endif
            </x-table.row>

        @empty

            <x-table.row>
                <x-table.cell class="text-center" colspan="7">No reinvested grants yet</x-table.cell>
            </x-table.row>

        @endforelse
        </x-slot>
    </x-table>

    @if(empty($print))
    <div class="mt-5 text-right print:hidden">
        <x-button.secondary id="add-reinvest" wire:click="showAdd">
            Add
        </x-button.secondary>
    </div>
    @endif

    <x-modal.dialog wire:model="showAddModal">
        <x-slot name="title">Add / Edit Reinvested Grants</x-slot>

        <x-slot name="content">
            <div class="my-4 md:w-1/2">
                <x-form.input :id="'reinvested-type_subtype'" :label="'Type / Subtype'" :hasError="$errors->has('currentReinvested.type_subtype')" wire:model="currentReinvested.type_subtype">
                </x-form.input>

                @error ('currentReinvested.type_subtype')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="my-4 md:w-1/2">
                <x-form.simple-currency :id="'reinvested-grant'" :label="'Grant'" :hasError="$errors->has('currentReinvested.grant')" wire:model="currentReinvested.grant">
                </x-form.simple-currency>

                @error ('currentReinvested.grant')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-end mt-4 space-x-3">
                <x-button.primary wire:click="addReinvested">
                    Save
                </x-button.primary>

                <x-button.secondary wire:click="$set('showAddModal', false)">
                    Cancel
                </x-button.secondary>
            </div>
        </x-slot>
    </x-modal.dialog>

    <!-- Delete Reinvested Modal -->
    <x-modal.confirmation wire:model.defer="showDeleteModal">
        <x-slot name="title">Delete Reinvested Grant</x-slot>

        <x-slot name="content">
            <div class="py-8 text-xl remove-reinvested-confirmation">
                Are you sure you want to remove this reinvested grant?
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-end space-x-3">
                <x-button.primary class="confirm-remove-reinvested" wire:click="deleteReinvested()">Yes</x-button>
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button>
            </div>
        </x-slot>
    </x-modal.confirmation>
</div>
