<div class="my-16">
    <input type="hidden" name="participant_count" wire:model="participantCount">
    <h3 class="my-4 text-lg font-normal leading-tight">
        Participants to the Grouping
    </h3>
    <x-table class="distributors-list {{ $errors->has('participant_count') ? 'border border-red-500' : '' }}">
        <x-slot name="head">
            <x-table.heading>DISTRIBUTION COUNTRY</x-table.heading>
            <x-table.heading>COMPANY NAME</x-table.heading>
            <x-table.heading>ROLE</x-table.heading>
            <x-table.heading>FORECAST RELEASE DATE</x-table.heading>
            <x-table.heading>P&A Costs</x-table.heading>
            <x-table.heading>FORECAST GRANT</x-table.heading>
            @if(empty($print))<x-table.heading>&nbsp;</x-table.heading>@endif
        </x-slot>

        <x-slot name="body">

            @forelse ($distributors as $index => $distributor)

            <x-table.row>
                <x-table.cell class="text-center">{{ $distributor->country->name }}</x-table.cell>
                <x-table.cell class=" text-center">{{ $distributor->name }}</x-table.cell>
        <x-table.cell class="text-center">{{ $distributor->role }}</x-table.cell>
        <x-table.cell class="text-center">
            {{ $distributor->forecast_release_date }}
        </x-table.cell>
        <x-table.cell class="text-center">
            {{ !empty($distributor->pa_costs) ? euro($distributor->pa_costs) : '' }}
        </x-table.cell>
        <x-table.cell class="text-center">
            {{ !empty($distributor->pa_costs) ? euro($distributor->forecast_grant) : '' }}
        </x-table.cell>
        @if(empty($print))
        <x-table.cell class="space-x-2 text-center">
            <a wire:click="showAdd({{ $distributor->id }})" class="text-indigo-600 cursor-pointer hover:text-indigo-900 print:hidden edit-distributor">
                Edit
            </a>
            <a wire:click="showDelete({{ $distributor->id }})" class="text-red-600 cursor-pointer hover:text-red-900 print:hidden remove-distributor">
                Remove
            </a>
        </x-table.cell>
        @endif
        </x-table.row>

        @empty

        <x-table.row>
            <x-table.cell class="text-center" colspan="7">No distributors yet</x-table.cell>
        </x-table.row>

        @endforelse
        </x-slot>
    </x-table>

    @error('participant_count')
    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
    @enderror

    @if(empty($print))
    <div class="mt-5 text-right print:hidden">
        <x-button.secondary id="add-distributor" wire:click="showAdd" wire:loading.attr="disabled" :disabled="$dossier->call->closed">
            Add
        </x-button.secondary>
    </div>
    @endif

    <div id="cc-init" x-data x-init="

    Livewire.on('showModalInit_Distributors', () => {

        // Re-init the date picker.
        // Just target the unique ID, since this code is just for one date picker.
        if (typeof(pikaday_distributors_release_date) !== 'undefined')
            pikaday_distributors_release_date.destroy();
        pikaday_distributors_release_date = new Pikaday({
            field: document.getElementById('distributors-forecast-release-date'),
            theme: 'moviedb-theme',
            format: 'DD.MM.YYYY',
            firstDay: 1,
        })

    })

    ">
    </div>

    <x-modal.dialog wire:model="showAddModal">
        <x-slot name="title">Add / Edit Distributor</x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-form.select :id="'distribution-country'" :label="'Distribution Country'" :hasError="$errors->has('currentDistributor.country_id')" wire:model="currentDistributor.country_id">
                    @foreach ($countriesGrouped as $group=>$countries)
                    <optgroup label="---">
                        @foreach ($countries as $country)
                        <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                        @endforeach
                    </optgroup>
                    @endforeach
                </x-form.select>

                @error ('currentDistributor.country_id')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-4 md:w-1/2">
                <x-form.input :id="'distributor-company'" :label="'Company Name'" :hasError="$errors->has('currentDistributor.name')" wire:model="currentDistributor.name">
                </x-form.input>

                @error ('currentDistributor.name')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-4">
                <x-form.select :id="'company-role'" :label="'Company Role'" :hasError="$errors->has('currentDistributor.role')" wire:model="currentDistributor.role">
                    @foreach ($distributorRoles as $distributorRole)
                    <option value="{{ $distributorRole }}">
                        {{ $distributorRole }}
                    </option>
                    @endforeach
                </x-form.select>

                @error ('currentDistributor.role')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-4 md:w-1/2">
                <x-form.datepicker :id="'distributors-forecast-release-date'" :label="'Forecast Release Date'" :hasError="$errors->has('currentDistributor.forecast_release_date')" wire:model="currentDistributor.forecast_release_date">
                </x-form.datepicker>

                @error ('currentDistributor.forecast_release_date')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-4 md:w-1/2">
                <x-form.simple-currency :id="'pa-costs'" :label="'P&A Costs'" :hasError="$errors->has('currentDistributor.pa_costs')" wire:model="currentDistributor.pa_costs">
                </x-form.simple-currency>

                @error ('currentDistributor.pa_costs')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-4 md:w-1/2">
                <x-form.simple-currency :id="'forecast-grant'" :label="'Forecast Grant'" :hasError="$errors->has('currentDistributor.forecast_grant')" wire:model="currentDistributor.forecast_grant">
                </x-form.simple-currency>

                @error ('currentDistributor.forecast_grant')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-end mt-4 space-x-3">
                <x-button.primary wire:click="addDistributor">
                    Save
                </x-button.primary>

                <x-button.secondary wire:click="$set('showAddModal', false)">
                    Cancel
                </x-button.secondary>
            </div>
        </x-slot>
    </x-modal.dialog>

    <!-- Delete Distributor Modal -->
    <x-modal.confirmation wire:model.defer="showDeleteModal">
        <x-slot name="title">Delete Distributor</x-slot>

        <x-slot name="content">
            <div class="py-8 text-xl remove-distributor-confirmation">
                Are you sure you want to remove this distributor?
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-end space-x-3">
                <x-button.primary class="confirm-remove-distributor" wire:click="deleteDistributor()">Yes</x-button>

                    <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button>
            </div>
        </x-slot>
    </x-modal.confirmation>

    <x-modal.confirmation wire:model.defer="showNoMovieModal">
        <x-slot name="title">Movie not selected</x-slot>

        <x-slot name="content">
            <div class="py-8 text-xl">
                You must select a movie in order to add distributors
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-end space-x-3">
                <x-button.primary wire:click="$set('showNoMovieModal', false)">OK</x-button>
            </div>
        </x-slot>
    </x-modal.confirmation>
</div>
