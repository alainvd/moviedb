<div>
    
    <div class="text-lg mb-8">
        Cast and Crew
    </div>

    <div x-data="{ points_total: {{ $points_total }} }">
        <x-table>
            <x-slot name="head">
                <x-table.heading>Title</x-table.heading>
                <x-table.heading>Full name</x-table.heading>
                <x-table.heading>Gender</x-table.heading>
                <x-table.heading>Nationality 1</x-table.heading>
                <x-table.heading>Nationality 2</x-table.heading>
                <x-table.heading>Residence</x-table.heading>
                @if ($backoffice)<x-table.heading>Scoring</x-table.heading>@endif
                <x-table.heading></x-table.heading>
            </x-slot>

            <x-slot name="body">
                @foreach ($items as $item)
                <x-table.row>
                    <x-table.cell class="text-center">{{ $titles[$item['title_id']]['name'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['person']['firstname'] }} {{ $item['person']['lastname'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $genders[$item['person']['gender']] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['person']['nationality1'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['person']['nationality2'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['person']['country_of_residence'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['points'] }}</x-table.cell>
                    <x-table.cell class="text-center space-x-2">
                        <a wire:click="showModalEdit('{{ $item['key'] }}')" class="cursor-pointer">Edit</a>
                        <a wire:click="showModalDelete('{{ $item['key'] }}')" class="cursor-pointer">Delete</a>
                    </x-table.cell>
                </x-table.row>
                @endforeach
            </x-slot>
        </x-table>

        <div class="mt-5 text-right">
            @if ($backoffice)
            <span class="mr-4">
                TOTAL SCORE: <span class="font-bold" x-text="points_total"></span>
            </span>
            @endif
            <x-button.secondary wire:click="showModalAdd" wire:loading.attr="disabled">
                Add
            </x-button.secondary>
        </div>
    </div>

    <form class="space-y-2">
        <x-modal.dialog wire:model="showingEditModal">
            <x-slot name="title">
                Add/Edit person
            </x-slot>

            <x-slot name="content">
                <div class="space-y-2">

                    <div>
                        <x-form.select
                            :id="'crews_title_id'"
                            :label="'Title'"
                            wire:model="editing.title_id">
                
                            @foreach ($titles as $id => $title)
                                <option value="{{ $id }}">{{ $title['name'] }}</option>
                            @endforeach
                        </x-form.select>
                
                        @error('editing.title_id')
                            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.input
                            :id="'crews_firstname'"
                            :label="'First name'"
                            wire:model="editing.person.firstname">
                        </x-form.input>

                        @error('editing.person.firstname')
                            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.input
                            :id="'crews_lastname'"
                            :label="'Last name'"
                            wire:model="editing.person.lastname">
                        </x-form.input>

                        @error('editing.person.lastname')
                            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.select
                            :id="'crews_gender'"
                            :label="'Gender'"
                            wire:model="editing.person.gender">
                
                            @foreach ($genders as $key => $name)
                                <option value="{{ $key }}">{{ $name }}</option>
                            @endforeach
                        </x-form.select>
                
                        @error('editing.person.gender')
                            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.select
                            :id="'crews_nationality1'"
                            :label="'Nationality 1'"
                            wire:model="editing.person.nationality1">
                
                            @foreach ($countries as $country)
                                <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                            @endforeach
                        </x-form.select>
                
                        @error('editing.person.nationality1')
                            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.select
                            :id="'crews_nationality2'"
                            :label="'Nationality 2'"
                            wire:model="editing.person.nationality2">
                
                            @foreach ($countries as $country)
                                <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                            @endforeach
                        </x-form.select>
                
                        @error('editing.person.nationality2')
                            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.select
                            :id="'crews_country_of_residence'"
                            :label="'Country of residence'"
                            wire:model="editing.person.country_of_residence">
                
                            @foreach ($countries as $country)
                                <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                            @endforeach
                        </x-form.select>
                
                        @error('editing.person.country_of_residence')
                            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.input
                            :id="'crews_points'"
                            :label="'Points'"
                            wire:model="editing.points">
                        </x-form.input>

                        @error('editing.points')
                            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

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

