<div>
    
    <div class="mb-8 text-lg">
        Producers
    </div>

    <div>
        <x-table>
            <x-slot name="head">
                <x-table.heading>Role</x-table.heading>
                <x-table.heading>Name</x-table.heading>
                <x-table.heading>City</x-table.heading>
                <x-table.heading>Country</x-table.heading>
                <x-table.heading>Share</x-table.heading>
                <x-table.heading></x-table.heading>
            </x-slot>
            
            <x-slot name="body">
                @foreach ($items as $item)
                <x-table.row>
                    <x-table.cell class="text-center">{{ $producer_roles[$item['role']] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['name'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['city'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ !empty($item['country_id']) ? $countries[$item['country_id']]['name'] : '' }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['share'] }}%</x-table.cell>
                    <x-table.cell class="space-x-2 text-center">
                        <a wire:click="showModalEdit('{{ $item['key'] }}')" class="cursor-pointer">Edit</a>
                        <a wire:click="showModalDelete('{{ $item['key'] }}')" class="cursor-pointer">Delete</a>
                    </x-table.cell>
                </x-table.row>
                @endforeach
            </x-slot>
        </x-table>

        <div class="mt-5 text-right">
            <x-button.secondary wire:click="showModalAdd" wire:loading.attr="disabled">
                Add
            </x-button.secondary>
        </div>
    </div>

    <form class="space-y-2">
        <x-modal.dialog wire:model="showingEditModal">
            <x-slot name="title">
                Add/Edit producer
            </x-slot>

            <x-slot name="content">
                <div class="space-y-2">

                    <div>
                        <x-form.select
                            :id="'producer_role'"
                            :label="'Role'"
                            :hasError="$errors->has('editing.role')"
                            wire:model="editing.role">
                
                            @foreach($producer_roles as $key => $name)
                                <option value="{{ $key }}">{{ $name }}</option>
                            @endforeach
                        </x-form.select>
                
                        @error('editing.role')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.input
                            :id="'producer_name'"
                            :label="'Name'"
                            :hasError="$errors->has('editing.name')"
                            wire:model="editing.name">
                        </x-form.input>

                        @error('editing.name')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.input
                            :id="'producer_city'"
                            :label="'City'"
                            :hasError="$errors->has('editing.city')"
                            wire:model="editing.city">
                        </x-form.input>

                        @error('editing.city')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.select
                            :id="'producer_country_id'"
                            :label="'Country'"
                            :hasError="$errors->has('editing.country_id')"
                            wire:model="editing.country_id">
                
                            @foreach ($countries as $country)
                                <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                            @endforeach
                        </x-form.select>
                
                        @error('editing.country_id')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.input-trailing
                            :id="'producer_share'"
                            :label="'Share'"
                            :trailing="'%'"
                            :hasError="$errors->has('editing.share')"
                            wire:model="editing.share"
                        > 
                        </x-form.input>
                        @error('editing.share')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

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
            <x-slot name="title">Delete producer</x-slot>

            <x-slot name="content">
                <div class="py-8">Do you want to remove this producer?</div>
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

