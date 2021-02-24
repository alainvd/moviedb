<div class="mb-8 text-lg">
        Technical Information
    </div>
<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-photography-dev-current">

    

    <div class="col-span-1">
        <x-form.datepicker
            :id="'photography_start'"
            :label="'Start Date of Principal Photography'"
            :hasError="$errors->has('movie.photography_start')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.photography_start')"
            wire:model.lazy="movie.photography_start">
        </x-form.datepicker>

        @error('movie.photography_start')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.datepicker
            :id="'photography_end'"
            :label="'End Date of Principal Photography'"
            wire:model.lazy="movie.photography_end">
        </x-form.datepicker>   
    </div>
    <br>
    <div class="col-span-1">
        <x-form.datepicker
            :id="'delivery_date'"
            :label="'Date of First Delivery'"
            :isRequired="FormHelpers::isRequired($rules, 'movie.delivery_date')"
            wire:model.lazy="movie.delivery_date">
        </x-form.datepicker>    
    </div>

    <div class="col-span-1">
        <x-form.datepicker
            :id="'broadcast_date'"
            :label="'Date of First Broadcast'"
            :isRequired="FormHelpers::isRequired($rules, 'movie.broadcast_date')"
            wire:model.lazy="movie.broadcast_date">
        </x-form.datepicker> 
    </div>

    <div
        x-data="{ error: {{ $errors->has('movie.shooting_language') ? 1 : 0 }} }"
        x-init="$watch('error', value => error == 1 ? 
        document.getElementById('shooting-language').parentElement.classList.add('border', 'rounded-md', 'border-red-500')
        : 
        document.getElementById('shooting-language').parentElement.classList.remove('border', 'rounded-md', 'border-red-500')
        )"
        class="col-span-1 col-start-3 sm:col-span-1">
        @livewire('select-component', [
            'domId' => 'shooting-language',
            'label' => 'Shooting language',
            'isRequired' => FormHelpers::isRequired($rules, 'movie.shooting_language'),
            'name' => 'shootingLanguages',
            'options' => json_encode($languages),
            'items' => json_encode($languagesSelected),
        ])

        @error('movie.shooting_language')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-span-1">
        <x-form.input-trailing
            :id="'development_costs_in_euro'"
            :label="'Development cost'"
            :trailing="'€'"
            :hasError="$errors->has('movie.development_costs_in_euro')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.development_costs_in_euro')"
            wire:model="movie.development_costs_in_euro">
        </x-form.input>

        @error('movie.development_costs_in_euro')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-1">
        <x-form.input-trailing
            :id="'film_length'"
            :label="'Total duration'"
            :trailing="'Minutes'"
            :hasError="$errors->has('movie.film_length')"
            wire:model="movie.film_length">
        </x-form.input>

        @error('movie.film_length')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- dependent field -->
    <div class="col-span-1 col-start-2" x-data="{ show: false }" x-show="$wire.movie.film_type == 'SERIES'">
        <x-form.input
            :id="'number_of_episodes'"
            :label="'Number of episodes'"
            :hasError="$errors->has('movie.number_of_episodes')"
            wire:model="movie.number_of_episodes">
        </x-form.input>

        @error('movie.number_of_episodes')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- dependent field -->
    <div class="col-span-1 col-start-3" x-data="{ show: false }" x-show="$wire.movie.film_type == 'SERIES'">
        <x-form.input-trailing
            :id="'length_of_episodes'"
            :label="'Average duration of episode'"
            :trailing="'Minutes'"
            :hasError="$errors->has('movie.length_of_episodes')"
            wire:model="movie.length_of_episodes">
        </x-form.input>

        @error('movie.length_of_episodes')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
</div>
