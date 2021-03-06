<div>

    <div class="mb-4 text-lg">
        <h3>Cast and Crew</h3>
    </div>

    @if(empty($print))
    <div class="my-2 text-sm text-gray-600 print:hidden">Please input TBC for mandatory roles not defined.</div>
    @endif

    <div x-data="{ points_total: {{ $points_total }} }">
        <x-table>
            <x-slot name="head">
                <x-table.heading>Role</x-table.heading>
                <x-table.heading>Full name</x-table.heading>
                <x-table.heading>Gender</x-table.heading>
                @if($fiche=='dist')
                    <x-table.heading>Nationality 1</x-table.heading>
                @else
                    <x-table.heading>Nationality</x-table.heading>
                @endif
                @if($fiche=='dist')<x-table.heading>Nationality 2</x-table.heading>@endif
                @if($fiche=='dist')<x-table.heading>Residence</x-table.heading>@endif
                @if ($isEditor && $fiche=='dist')<x-table.heading>Scoring</x-table.heading>@endif
                @if(empty($print))<x-table.heading></x-table.heading>@endif
            </x-slot>

            <x-slot name="body">
                @foreach ($items as $item)
                <x-table.row>
                    <x-table.cell class="text-left">
                        {{ $titles[$item['title_id']]['name'] }}
                        @if($item['required'])<span class="text-red-500">*</span>@endif
                    </x-table.cell>
                    <x-table.cell class="text-center">{{ $item['person']['firstname'] }} {{ $item['person']['lastname'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ !empty($item['person']['gender']) ? $genders[$item['person']['gender']] : '' }}</x-table.cell>
                    <x-table.cell class="text-center">{{ !empty($item['person']['nationality1']) ? $countriesByCode[$item['person']['nationality1']]['name'] : '' }}</x-table.cell>
                    @if($fiche=='dist')<x-table.cell class="text-center">{{ !empty($item['person']['nationality2']) ? $countriesByCode[$item['person']['nationality2']]['name'] : '' }}</x-table.cell>@endif
                    @if($fiche=='dist')<x-table.cell class="text-center">{{ !empty($item['person']['country_of_residence']) ? $countriesByCode[$item['person']['country_of_residence']]['name'] : '' }}</x-table.cell>@endif
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
                Add/Edit person
            </x-slot>

            <x-slot name="content">
                <div class="space-y-2">

                    <div>
                        <x-form.select
                            :id="'crews_title_id'"
                            :label="'Role'"
                            :hasError="$errors->has('editing.title_id')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.title_id')"
                            wire:model="editing.title_id">

                            @foreach ($titles as $id => $title)
                                <option value="{{ $id }}">{{ $title['name'] }}</option>
                            @endforeach
                        </x-form.select>

                        @error('editing.title_id')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.input
                            :id="'crews_firstname'"
                            :label="'First name'"
                            :hasError="$errors->has('editing.person.firstname')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.person.firstname')"
                            wire:model="editing.person.firstname">
                        </x-form.input>

                        @error('editing.person.firstname')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.input
                            :id="'crews_lastname'"
                            :label="'Last name'"
                            :hasError="$errors->has('editing.person.lastname')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.person.lastname')"
                            wire:model="editing.person.lastname">
                        </x-form.input>

                        @error('editing.person.lastname')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.select
                            :id="'crews_gender'"
                            :label="'Gender'"
                            :hasError="$errors->has('editing.person.gender')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.person.gender')"
                            wire:model="editing.person.gender">

                            @foreach ($genders as $key => $name)
                                <option value="{{ $key }}">{{ $name }}</option>
                            @endforeach
                        </x-form.select>

                        @error('editing.person.gender')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.select
                            :id="'crews_nationality1'"
                            :label="$fiche=='dist' ? 'Nationality 1' : 'Nationality'"
                            :hasError="$errors->has('editing.person.nationality1')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.person.nationality1')"
                            wire:model="editing.person.nationality1"
                        >

                            @foreach ($countriesGrouped as $group=>$countries)
                                <optgroup label="---">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        
                        </x-form.select>

                        @error('editing.person.nationality1')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($fiche=='dist')
                    <div>
                        <x-form.select
                            :id="'crews_nationality2'"
                            :label="'Nationality 2'"
                            :hasError="$errors->has('editing.person.nationality2')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.person.nationality2')"
                            wire:model="editing.person.nationality2"
                        >

                            @foreach ($countriesGrouped as $group=>$countries)
                                <optgroup label="---">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach

                        </x-form.select>

                        @error('editing.person.nationality2')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    @if($fiche=='dist')
                    <div>
                        <x-form.select
                            :id="'crews_country_of_residence'"
                            :label="'Country of residence'"
                            :hasError="$errors->has('editing.person.country_of_residence')"
                            :isRequired="FormHelpers::isRequired($rules, 'editing.person.country_of_residence')"
                            wire:model="editing.person.country_of_residence"
                        >

                            @foreach ($countriesGrouped as $group=>$countries)
                                <optgroup label="---">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach                            

                        </x-form.select>

                        @error('editing.person.country_of_residence')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    @if($isEditor && $fiche=='dist')
                    <div>
                        <x-form.input
                            :id="'crews_points'"
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
            <x-slot name="title">Delete person</x-slot>

            <x-slot name="content">
                <div class="py-8">Do you want to remove this person?</div>
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

