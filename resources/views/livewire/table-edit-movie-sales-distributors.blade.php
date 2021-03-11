<div>
    
    <div class="mb-8 text-lg">
        Countries of Distribution
    </div>

    @if($isApplicant == true)
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
                <x-table.heading>Role</x-table.heading>
                <x-table.heading>Countries</x-table.heading>
                <x-table.heading>Release/Broadcast Date</x-table.heading>
                @if(empty($print))<x-table.heading></x-table.heading>@endif
            </x-slot>
            
            <x-slot name="body">
                @foreach ($items as $item)
                <x-table.row>
                    <x-table.cell class="text-center">{{ $item['name'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $distributorRoles[$item['role']] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ !empty($item['countries']) ? collect($countries_value_label)->filter(
                        function ($c) use ($item) {
                            return in_array($c['value'], collect($item['countries'])->pluck('id')->toArray());
                        }
                    )->pluck('label')->join(', ') : '' }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['release_date'] }}</x-table.cell>
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

    <div id="cc-init" x-data x-init="

    Livewire.on('showModalInit', countries_values => {

        // delete existing choices element
        document.getElementById('cc-init-item').innerHTML = '';

        // create new select-multiple element from template
        var cc = document.createElement('select');
        cc.id = 'cc';
        cc.setAttribute('multiple', true);
        document.getElementById('cc-init-item').appendChild(cc);
        
        var choices = new Choices(cc, {
            removeItemButton: true,
            duplicateItemsAllowed: false,
            choices: {{ json_encode($countries_value_label) }},
        });

        choices.setValue(countries_values);

        choices.passedElement.element.addEventListener(
            'addItem',
            function(event) {
                $wire.addCountry(event.detail.value);
            },
            false,
        );
        
        choices.passedElement.element.addEventListener(
            'removeItem',
            function(event) {
                $wire.removeCountry(event.detail.value);
            },
            false,
        );

    })

    ">
    </div>

    <form class="space-y-2 z-100">
        <x-modal.dialog wire:model="showingEditModal">
            <x-slot name="title">
                Add/Edit distribution countries
            </x-slot>

            <x-slot name="content">
                
                <div class="space-y-2">

                    <div>
                        <x-form.input
                            :id="'distributors_name'"
                            :label="'Company Name'"
                            :hasError="$errors->has('editing.name')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.name')"
                            wire:model="editing.name">
                        </x-form.input>

                        @error('editing.name')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.select
                            :id="'distributors_role'"
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

                    <div>
                        <label for="" class="block text-sm font-light leading-5 text-gray-700">
                            Countries
                            <span class="text-red-500">*</span>
                        </label>
                        
                        <div id="cc-init-item" wire:ignore></div>

                        @error('editing.countries')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <x-form.datepicker
                            :id="'distributors_release_date'"
                            :label="'Release/Broadcast Date'"
                            :hasError="$errors->has('editing.release_date')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.release_date')"
                            wire:model.lazy="editing.release_date">
                        </x-form.datepicker>
                
                        @error('editing.release_date')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="flex items-center justify-end mt-4 space-x-3">
                    <x-button.primary wire:click="saveItem()">Save</x-button.primary>

                    <x-button.secondary wire:click="cancel()">Cancel</x-button.secondary>
                </div>
            </x-slot>

            <x-slot name="footer">
            </x-slot>
        </x-modal.dialog>
    </form>

    <form wire:submit.prevent="deleteItem">
        <x-modal.confirmation wire:model.defer="showingDeleteModal">
            <x-slot name="title">Delete distribution countries</x-slot>

            <x-slot name="content">
                <div class="py-8">Do you want to remove this distribution countries?</div>
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
