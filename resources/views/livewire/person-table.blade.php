<div>

    <div class="px-6 py-4">
        <div class="text-lg">
            Cast and Crew
        </div>
    </div>

    <x-table>
        <x-slot name="head">
            <x-table.heading>Role</x-table.heading>
            <x-table.heading>Full name</x-table.heading>
            <x-table.heading>Gender</x-table.heading>
            <x-table.heading>Nationality 1</x-table.heading>
            <x-table.heading>Nationality 2</x-table.heading>
            <x-table.heading>Residence</x-table.heading>
            @if ($backoffice)<x-table.heading>Scoring</x-table.heading>@endif
            <x-table.heading></x-table.heading>
        </x-slot>

        <x-slot name="body">
            @foreach ($peopleOnForm as $person)
            <x-table.row wire:key="{{ $person['key'] }}">
                <x-table.cell class="text-center">{{ $person['role'] }}</x-table.cell>
                <x-table.cell class="text-center">{{ $person['first_name'] }} {{ $person['last_name'] }}</x-table.cell>
                <x-table.cell class="text-center">{{ $person['gender'] }}</x-table.cell>
                <x-table.cell class="text-center">{{ $person['nationality1'] }}</x-table.cell>
                <x-table.cell class="text-center">{{ $person['nationality2'] }}</x-table.cell>
                <x-table.cell class="text-center">{{ $person['country_of_residence'] }}</x-table.cell>
                @if ($backoffice)<x-table.heading>- 2 +</x-table.heading>@endif
                <x-table.cell class="text-center space-x-2">
                    <a wire:click="showModalEdit('{{ $person['key'] }}')" class="cursor-pointer">Edit</a>
                    <a wire:click="showModalDelete('{{ $person['key'] }}')" class="cursor-pointer">Delete</a>
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

    <!-- Add/Edit Person Modal -->
    <form class="space-y-2">
        <x-modal.dialog wire:model="showingEditModal">
            <x-slot name="title">
                Add/Edit person
            </x-slot>

            <x-slot name="content">
                <div>
                    <label for="type" class="block text-sm font-medium leading-5 text-gray-700">Type</label>
                    <select wire:model="personEditing.type" id="type"
                        class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="crew">Crew</option>
                        <option value="cast">Cast</option>
                    </select>
                    @error('personEditing.type') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium leading-5 text-gray-700">Role</label>
                    <select wire:model="personEditing.role" id="role"
                        class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="actor">Actor</option>
                        <option value="director">Director</option>
                        <option value="scriptwrited">Scriptwriter</option>
                    </select>
                    @error('personEditing.role') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">First name</label>
                    <input wire:model="personEditing.first_name" id="first_name"
                        class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    @error('personEditing.first_name') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium leading-5 text-gray-700">Last name</label>
                    <input wire:model="personEditing.last_name" id="last_name"
                        class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    @error('personEditing.last_name') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium leading-5 text-gray-700">Gender</label>
                    <select wire:model="personEditing.gender" id="gender"
                        class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="na">N/A</option>
                    </select>
                    @error('personEditing.gender') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="nationality1" class="block text-sm font-medium leading-5 text-gray-700">Nationality
                        1</label>
                    <select wire:model="personEditing.nationality1" id="nationality1"
                        class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="belgian">Belgian</option>
                        <option value="french">French</option>
                        <option value="german">German</option>
                    </select>
                    @error('personEditing.nationality1') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="nationality2" class="block text-sm font-medium leading-5 text-gray-700">Nationality
                        2</label>
                    <select wire:model="personEditing.nationality2" id="nationality2"
                        class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value=""></option>
                        <option value="belgian">Belgian</option>
                        <option value="french">French</option>
                        <option value="german">German</option>
                    </select>
                    @error('personEditing.nationality2') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="country_of_residence" class="block text-sm font-medium leading-5 text-gray-700">Country
                        of residence</label>
                    <select wire:model="personEditing.country_of_residence" id="country_of_residence"
                        class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value=""></option>
                        <option value="be">Belgium</option>
                        <option value="fr" selected>France</option>
                        <option value="de">Germany</option>
                    </select>
                    @error('personEditing.country_of_residence') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end items-center space-x-3 mt-4">
                    <!-- Use button click (instead of form submit), bacause this form is nested inside the parent Movie details form. -->
                    <!-- When forms are nested, the parent form is submitted instead of child form. -->
                    <x-button.primary wire:click="savePerson">Save</x-button.primary>

                    <x-button.secondary wire:click="$set('showingEditModal', false)">Cancel</x-button.secondary>
                </div>
            </x-slot>

            <x-slot name="footer">
            </x-slot>
        </x-modal.dialog>
    </form>

    <!-- Delete Person Modal -->
    <form wire:submit.prevent="deletePerson">
        <x-modal.confirmation wire:model.defer="showingDeleteModal">
            <x-slot name="title">Delete person</x-slot>

            <x-slot name="content">
                <div class="py-8">Do you want to remove this person?</div>
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