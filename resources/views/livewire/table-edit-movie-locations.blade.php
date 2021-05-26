<div>

    <div class="mb-4 text-lg">
        <h3>Locations</h3>
    </div>

    <div x-data="{ points_total: {{ $points_total }} }">
        <x-table>
            <x-slot name="head">
                <x-table.heading>Type</x-table.heading>
                <x-table.heading>Name</x-table.heading>
                <x-table.heading>Country</x-table.heading>
                @if ($isEditor && $fiche=='dist')<x-table.heading>Scoring</x-table.heading>@endif
                @if(empty($print))<x-table.heading></x-table.heading>@endif
            </x-slot>

            <x-slot name="body">
                @foreach ($items as $item)
                <x-table.row>
                    <x-table.cell class="text-left">
                        {{ !empty($item['type']) ? $locationTypes[$item['type']] : '' }}
                        @if($item['required'])<span class="text-red-500">*</span>@endif
                    </x-table.cell>
                    <x-table.cell class="text-center">{{ $item['name'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ !empty($item['country']) ? $countriesByCode[$item['country']]['name'] : '' }}</x-table.cell>
                    @if ($isEditor && $fiche=='dist')<x-table.cell class="text-center">{{ $item['points'] }}</x-table.cell>@endif
                    @if(empty($print))<x-table.cell class="space-x-2 text-center">
                        <a wire:click="showModalEdit('{{ $item['key'] }}')" class="text-indigo-700 cursor-pointer print:hidden">Edit</a>
                        @if(!$item['required'])
                        <a wire:click="showModalDelete('{{ $item['key'] }}')" class="text-red-600 cursor-pointer print:hidden">Delete</a>
                        @else
                        <span class="text-gray-400 print:hidden">Delete</span>
                        @endif
                    </x-table.cell>@endif
                </x-table.row>
                @endforeach
            </x-slot>
        </x-table>

        @if(empty($print))
        <div class="mt-5 text-right print:hidden">
            <x-button.secondary wire:click="showModalAdd" wire:loading.attr="disabled">
                Add
            </x-button.secondary>
        </div>
        @endif
    </div>

    <form class="space-y-2">
        <x-modal.dialog wire:model="showingEditModal">
            <x-slot name="title">
                Add/Edit location
            </x-slot>

            <x-slot name="content">
                <div class="space-y-2">

                    <div>
                        <x-form.select
                            :id="'locations_type'"
                            :label="'Type'"
                            :hasError="$errors->has('editing.type')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.type')"
                            wire:model="editing.type">

                            @foreach ($locationTypes as $key => $name)
                                <option value="{{ $key }}">{{ $name }}</option>
                            @endforeach
                        </x-form.select>

                        @error('editing.type')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.input
                            :id="'locations_name'"
                            :label="'Name'"
                            :hasError="$errors->has('editing.name')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.name')"
                            wire:model="editing.name">
                        </x-form.input>

                        @error('editing.name')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($fiche=='dist' || $fiche=='devCurrent')
                    <div>
                        <x-form.select
                            :id="'locations_country'"
                            :label="'Country'"
                            :hasError="$errors->has('editing.country')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.country')"
                            wire:model="editing.country"
                        >

                            @foreach ($countriesGrouped as $group=>$countries)
                                <optgroup label="---">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                            
                        </x-form.select>

                        @error('editing.country')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    @if($isEditor && $fiche=='dist')
                    <div>
                        <x-form.input
                            :id="'location_points'"
                            :label="'Points'"
                            :hasError="$errors->has('editing.points')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.points')"
                            wire:model="editing.points"
                            placeholder="0.00">
                        </x-form.input>

                        @error('editing.points')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                </div>

                <div class="flex items-center justify-end mt-4 space-x-3">
                    <x-button.primary wire:click="saveItem">Save</x-button.primary>

                    <x-button.secondary wire:click="$set('showingEditModal', false)">Cancel</x-button.secondary>
                </div>
            </x-slot>

            <x-slot name="footer">
            </x-slot>
        </x-modal.dialog>
    </form>

    <form wire:submit.prevent="deleteItem">
        <x-modal.confirmation wire:model.defer="showingDeleteModal">
            <x-slot name="title">Delete location</x-slot>

            <x-slot name="content">
                <div class="py-8">Do you want to remove this location?</div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex items-center justify-end space-x-3">
                    <x-button.primary type="submit">Delete</x-button>

                    <x-button.secondary wire:click="$set('showingDeleteModal', false)">Cancel</x-button>
                </div>
            </x-slot>
        </x-modal.confirmation>
    </form>

</div>

