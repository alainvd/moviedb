<div>
    
    <div class="mb-8 text-lg">
        @if($fiche=='dist')
        Production Structure
        @endif
        @if($fiche=='devPrev')
        Production Structure
        @endif
        @if($fiche=='devCurrent')
        Estimated Production Structure
        @endif
    </div>

    <div x-data="{ budget_total: {{ $budget_total }} }">
        <x-table>
            <x-slot name="head">
                <x-table.heading>Role</x-table.heading>
                <x-table.heading>Name</x-table.heading>
                @if($fiche == 'dist')<x-table.heading>City</x-table.heading>@endif
                <x-table.heading>Country</x-table.heading>
                @if($fiche == 'devCurrent')<x-table.heading>Language</x-table.heading>@endif
                @if(in_array($fiche, ['dist', 'devPrev']))<x-table.heading>Share</x-table.heading>@endif
                @if($fiche == 'devPrev')<x-table.heading>Budget</x-table.heading>@endif
                <x-table.heading></x-table.heading>
            </x-slot>
            
            <x-slot name="body">
                @foreach ($items as $item)
                <x-table.row>
                    <x-table.cell class="text-center">{{ $producer_roles[$item['role']] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['name'] }}</x-table.cell>
                    @if($fiche == 'dist')<x-table.cell class="text-center">{{ $item['city'] }}</x-table.cell>@endif
                    <x-table.cell class="text-center">{{ !empty($item['country_id']) ? $countries[$item['country_id']]['name'] : '' }}</x-table.cell>
                    @if($fiche == 'devCurrent')<x-table.cell class="text-center">{{ !empty($item['language_id']) ? Arr::first($languages, function($value)use($item){return $value['value']==$item['language_id'];})['label'] : '' }}</x-table.cell>@endif
                    @if(in_array($fiche, ['dist', 'devPrev']))<x-table.cell class="text-center">{{ !empty($item['share']) ? $item['share'].'%' : '' }}</x-table.cell>@endif
                    @if($fiche == 'devPrev')<x-table.cell class="text-center">{{ isset($item['budget']) ? $item['budget'].'€' : '' }}</x-table.cell>@endif
                    <x-table.cell class="space-x-2 text-center">
                        <a wire:click="showModalEdit('{{ $item['key'] }}')" class="cursor-pointer">Edit</a>
                        <a wire:click="showModalDelete('{{ $item['key'] }}')" class="cursor-pointer">Delete</a>
                    </x-table.cell>
                </x-table.row>
                @endforeach
            </x-slot>
        </x-table>

        <div class="mt-5 text-right">
            @if($fiche == 'devPrev')
            <span class="mr-4">
                TOTAL BUDGET: <span class="font-bold" x-text="budget_total"></span>€
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

                    @if($fiche == 'dist')
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
                    @endif

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

                    @if($fiche == 'devCurrent')
                    <div class="col-span-3 sm:col-span-1">
                        <x-form.select
                            :id="'language_id'"
                            :label="'Language'"
                            :hasError="$errors->has('editing.language_id')"
                            wire:model="editing.language_id">
                
                            @foreach ($languages as $language)
                                <option value="{{ $language['value'] }}">{{$language['label']}}</option>
                            @endforeach
                
                        </x-form.select>
                
                        @error('editing.language_id')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    @if(in_array($fiche, ['dist', 'devPrev']))
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
                    @endif

                    @if($fiche == 'devPrev')
                    <div>
                        <x-form.input-trailing
                            :id="'producer_budget'"
                            :label="'Budget'"
                            :trailing="'€'"
                            :hasError="$errors->has('editing.budget')"
                            wire:model="editing.budget"
                        > 
                        </x-form.input>
                        @error('editing.budget')
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

