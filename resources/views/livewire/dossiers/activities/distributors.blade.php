<div class="my-16">
    <!-- Distributor counts -->
    <!-- <input type="hidden" name="coordinator_count" wire:model="coordinatorCount">
    <input type="hidden" name="participant_count" wire:model="participantCount"> -->

    <h3 class="text-lg leading-tight font-normal my-4">
        Distributors Participating in the Grouping
    </h3>
    <x-table class="{{ $errors->has('coordinator_count') || $errors->has('participant_count') ? 'border border-red-500' : '' }}">
        <x-slot name="head">
            <x-table.heading>DISTRIBUTION COUNTRY</x-table.heading>
            <x-table.heading>COMPANY NAME</x-table.heading>

            @if ($isBackoffice)

                <x-table.heading>ROLE</x-table.heading>

            @endif

            <x-table.heading>FORECAST RELEASE DATE</x-table.heading>

            @if ($isBackoffice)

                <x-table.heading>FORECAST GRANT</x-table.heading>

            @endif

            <x-table.heading>&nbsp;</x-table.heading>
        </x-slot>

        <x-slot name="body">

            @forelse ($distributors as $index => $distributor)

            <x-table.row>
                <x-table.cell class="text-center">{{ $distributor->country->name }}</x-table.cell>
                <x-table.cell class="text-center">{{ $distributor->name }}</x-table.cell>
                @if ($isBackoffice)
                    <x-table.cell class="text-center">{{ $distributor->role }}</x-table.cell>
                @endif
            <x-table.cell class="text-center">
                    {{ $distributor->forecast_release_date }}
                </x-table.cell>
                @if ($isBackoffice)
                    <x-table.cell class="text-center">
                        {{ $distributor->forecast_grant }}
                    </x-table.cell>
                @endif
                <x-table.cell class="text-center space-x-2">
                    <a
                        wire:click="showAdd({{ $distributor->id }})"
                        class="cursor-pointer text-indigo-600 hover:text-indigo-900">
                        Edit
                    </a>
                    <a
                        wire:click="showDelete({{ $distributor->id }})"
                        class="cursor-pointer text-red-600 hover:text-red-900">
                        Delete
                    </a>
                </x-table.cell>
            </x-table.row>

            @empty

            <x-table.row>
                <x-table.cell class="text-center" colspan="5">No distributors yet</x-table.cell>
            </x-table.row>

            @endforelse
        </x-slot>
    </x-table>

    @error('coordinator_count')
        <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
    @enderror

    @error('participant_count')
        <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
    @enderror

    <div class="mt-5 text-right">
        <x-button.secondary wire:click="showAdd" wire:loading.attr="disabled">
            Add
        </x-button.secondary>
    </div>

    <x-modal.dialog wire:model="showAddModal">
        <x-slot name="title">Add / Edit Distributor</x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-form.select
                    :id="'distribution-country'"
                    :label="'Distribution Country'"
                    :hasError="$errors->has('currentDistributor.country_id')"
                    wire:model="currentDistributor.country_id">
                    @foreach ($countries as $country)
                        <option value="{{ $country['id'] }}">
                            {{ $country['name'] }}
                        </option>
                    @endforeach
                </x-form.select>

                @error ('currentDistributor.country_id')
                    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-4">
                <x-form.input
                    :id="'company-name'"
                    :label="'Company Name'"
                    :hasError="$errors->has('currentDistributor.name')"
                    wire:model="currentDistributor.name">
                </x-form.input>

                @error ('currentDistributor.name')
                    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
            @if ($isBackoffice)
            <div class="my-4">
                <x-form.select
                    :id="'company-role'"
                    :label="'Company Role'"
                    :hasError="$errors->has('currentDistributor.role')"
                    wire:model="currentDistributor.role">
                    @foreach ($distributorRoles as $distributorRole)
                        <option value="{{ $distributorRole }}">
                            {{ $distributorRole }}
                        </option>
                    @endforeach
                </x-form.select>

                @error ('currentDistributor.role')
                    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
            @endif
            <div class="my-4">
                <x-form.datepicker
                    :id="'release-date'"
                    :label="'Forecast Release Date'"
                    :hasError="$errors->has('currentDistributor.forecast_release_date')"
                    wire:model="currentDistributor.forecast_release_date">
                </x-form.datepicker>

                @error ('currentDistributor.forecast_release_date')
                    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
            @if ($isBackoffice)
            <div class="my-4">
                <x-form.input
                    :id="'forecast-grant'"
                    :label="'Forecast Grant'"
                    :hasError="$errors->has('currentDistributor.forecast_grant')"
                    wire:model="currentDistributor.forecast_grant">
                </x-form.input>

                @error ('currentDistributor.forecast_grant')
                    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end items-center space-x-3 mt-4">
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
            <div class="py-8 text-xl">
                Are you sure you want to delete this distributor?
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end items-center space-x-3">
                <x-button.primary wire:click="deleteDistributor()">Yes</x-button>

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
            <div class="flex justify-end items-center space-x-3">
                <x-button.primary wire:click="$set('showNoMovieModal', false)">OK</x-button>
            </div>
        </x-slot>
    </x-modal.confirmation>
</div>
