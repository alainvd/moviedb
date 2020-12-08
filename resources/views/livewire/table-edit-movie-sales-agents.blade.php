<div>
    
    <div class="text-lg mb-8">
        Sales Agents
    </div>

    <div>
        <x-table>
            <x-slot name="head">
                <x-table.heading>Name</x-table.heading>
                <x-table.heading>Country</x-table.heading>
                <x-table.heading>Contact Person</x-table.heading>
                <x-table.heading>Email</x-table.heading>
                <x-table.heading></x-table.heading>
            </x-slot>
            
            <x-slot name="body">
                @foreach ($items as $item)
                <x-table.row>
                    <x-table.cell class="text-center">{{ $item['name'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $countries[$item['country_id']]['name'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['contact_person'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['email'] }}</x-table.cell>
                    <x-table.cell class="text-center space-x-2">
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
                Add/Edit sales agent
            </x-slot>

            <x-slot name="content">
                <div>
                    <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Name</label>
                    <input wire:model="editing.name" id="name"
                        class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    @error('editing.name') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="country_id" class="block text-sm font-medium leading-5 text-gray-700">Country</label>
                    <select wire:model="editing.country_id" id="country_id"
                        class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        @foreach ($countries as $country)
                            <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                        @endforeach
                    </select>
                    @error('editing.country_id') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="contact_person" class="block text-sm font-medium leading-5 text-gray-700">Contact person</label>
                    <input wire:model="editing.contact_person" id="contact_person"
                        class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    @error('editing.contact_person') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Email</label>
                    <input wire:model="editing.email" id="email"
                        class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    @error('editing.email') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end items-center space-x-3 mt-4">
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
                <div class="flex justify-end items-center space-x-3">
                    <x-button.primary type="submit">Delete</x-button>

                    <x-button.secondary wire:click="$set('showingDeleteModal', false)">Cancel</x-button>
                </div>
            </x-slot>
        </x-modal.confirmation>
    </form>

</div>

