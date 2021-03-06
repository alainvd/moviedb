<div>
    
    <div class="mb-4 text-lg">
        <h3>
        @if($fiche == 'dist')
        Sales Agents
        @endif
        @if($fiche == 'devPrev')
        Countries of Distribution
        @endif
        </h3>
    </div>

    @if($fiche == 'devPrev' && $isApplicant == true)
    <div class="grid grid-cols-4 gap-8 p-8 my-4 bg-blue-200 border-t-2 border-b-2 border-blue-400">
        <div class="col-span-4 text-gray-800 text-md">
            In order to be eligible, the recent work must fulfil minimum conditions in terms of having been commercially distributed. Please consult the Call’s eligibility criteria for the conditions that apply, and complete the table. The date to be provided is the one of the actual official release in cinema or the broadcast date.
        </div>
    </div>    
    @endif
    
    <div>
        <x-table>
            <x-slot name="head">
                <x-table.heading>Company Name</x-table.heading>
                @if($fiche=='devPrev')<x-table.heading>Role</x-table.heading>@endif
                <x-table.heading>Country</x-table.heading>
                @if($fiche=='dist')<x-table.heading>Contact Person</x-table.heading>@endif
                @if($fiche=='dist')<x-table.heading>Email</x-table.heading>@endif
                @if($fiche=='devPrev')<x-table.heading>Release/Broadcast Date</x-table.heading>@endif
                @if(empty($print))<x-table.heading></x-table.heading>@endif
            </x-slot>
            
            <x-slot name="body">
                @foreach ($items as $item)
                <x-table.row>
                    <x-table.cell class="text-center">{{ $item['name'] }}</x-table.cell>
                    @if($fiche=='devPrev')<x-table.cell class="text-center">{{ $distributorRoles[$item['role']] }}</x-table.cell>@endif
                    <x-table.cell class="text-center">{{ !empty($item['country']) ? $countriesByCode[$item['country']]['name'] : '' }}</x-table.cell>
                    @if($fiche=='dist')<x-table.cell class="text-center">{{ $item['contact_person'] }}</x-table.cell>@endif
                    @if($fiche=='dist')<x-table.cell class="text-center">{{ $item['email'] }}</x-table.cell>@endif
                    @if($fiche=='devPrev')<x-table.cell class="text-center">{{ $item['distribution_date'] }}</x-table.cell>@endif
                    @if(empty($print))<x-table.cell class="space-x-2 text-center">
                        <a wire:click="showModalEdit('{{ $item['key'] }}')" class="text-indigo-700 cursor-pointer print:hidden">Edit</a>
                        <a wire:click="showModalDelete('{{ $item['key'] }}')" class="text-red-600 cursor-pointer print:hidden">Delete</a>
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
                @if($fiche == 'dist')
                Add/Edit sales agent
                @endif
                @if($fiche == 'devPrev')
                Add/Edit distribution
                @endif
            </x-slot>

            <x-slot name="content">
                <div class="space-y-2">

                    <div>
                        <x-form.input
                            :id="'agents_name'"
                            :label="'Company Name'"
                            :hasError="$errors->has('editing.name')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.name')"
                            wire:model="editing.name">
                        </x-form.input>

                        @error('editing.name')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($fiche=='devPrev')
                    <div>
                        <x-form.select
                            :id="'agents_role'"
                            :label="'Role'"
                            :hasError="$errors->has('editing.role')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.role')"
                            wire:model="editing.role">
                
                            @foreach ($distributorRoles as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </x-form.select>
                
                        @error('editing.role')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    <div>
                        <x-form.select
                            :id="'agents_country'"
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

                    @if($fiche == 'dist')
                    <div>
                        <x-form.input
                            :id="'agents_contact_person'"
                            :label="'Contact person'"
                            :hasError="$errors->has('editing.contact_person')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.contact_person')"
                            wire:model="editing.contact_person">
                        </x-form.input>

                        @error('editing.contact_person')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    @if($fiche == 'dist')
                    <div>
                        <x-form.input
                            :id="'agents_email'"
                            :label="'Email'"
                            :hasError="$errors->has('editing.email')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.email')"
                            wire:model="editing.email">
                        </x-form.input>

                        @error('editing.email')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    @if($fiche == 'devPrev')
                    <div class="col-span-1">
                        <x-form.datepicker
                            :id="'agents_distribution_date'"
                            :label="'Release/Broadcast Date'"
                            :hasError="$errors->has('editing.distribution_date')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.distribution_date')"
                            wire:model.lazy="editing.distribution_date">
                        </x-form.datepicker>
                
                        @error('editing.distribution_date')
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
            <x-slot name="title">Delete sales agent</x-slot>

            <x-slot name="content">
                <div class="py-8">Do you want to remove this sales agent?</div>
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

