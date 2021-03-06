<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-tech-dev-current">

    <div class="col-span-2 mb-4 text-lg md:col-span-3">
        <h3>Technical information</h3>
    </div>

    <div class="col-span-1">
        <x-form.datepicker
            :print="$print"
            :id="'photography_start'"
            :label="'Start Date of Principal Photography'"
            :hasError="$errors->has('movie.photography_start')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.photography_start')"
            wire:model.lazy="movie.photography_start"
            value="{{ $movie->photography_start }}"
        ></x-form.datepicker>

        @error('movie.photography_start')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    @if (empty($print))
    <div
        x-data="{ error: {{ $errors->has('movie.shooting_language') ? 1 : 0 }} }"
        x-init="$watch('error', value => error == 1 ?
        document.getElementById('shooting-language').parentElement.classList.add('border', 'rounded-md', 'border-red-500')
        :
        document.getElementById('shooting-language').parentElement.classList.remove('border', 'rounded-md', 'border-red-500')
        )"
        class="col-span-1 col-start-3 sm:col-span-1">
        @livewire('select-component', [
            'ref' => 'choices_shooting_lang',
            'domId' => 'shooting-language',
            'label' => 'Shooting languages',
            'isRequired' => FormHelpers::isRequired($rules, 'movie.shooting_language'),
            'name' => 'shootingLanguages',
            'options' => json_encode($languagesGroupedChoices),
            'items' => json_encode($languagesSelected),
        ])

        @error('movie.shooting_language')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    @endif

    @if (!empty($print))
    <span class="font-bold">Shooting languages</span>
    <span>{{ $languagesSelected->implode('name', ', ') }}</span>
    @endif

    <div class="col-span-1">
        <x-form.input-trailing
            :print="$print"
            :id="'development_costs_in_euro'"
            :label="'Development cost'"
            :trailing="'€'"
            :isAmount="true"
            :hasError="$errors->has('movie.development_costs_in_euro')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.development_costs_in_euro')"
            wire:model="movie.development_costs_in_euro"
            value="{{ $movie->development_costs_in_euro }}"
        ></x-form.input-trailing>

        @error('movie.development_costs_in_euro')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-1">
        <x-form.input-trailing
            :print="$print"
            :id="'film_length'"
            :label="'Total duration'"
            :trailing="'Minutes'"
            :isAmount="false"
            :hasError="$errors->has('movie.film_length')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.film_length')"
            wire:model="movie.film_length"
            value="{{ $movie->film_length }}"
        ></x-form.input-trailing>

        @error('movie.film_length')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- dependent field -->
    <div class="col-span-1 col-start-2" x-data="{ show: false }" x-show="$wire.movie.film_type == 'SERIES'">
        <x-form.input
            :print="$print"
            :id="'number_of_episodes'"
            :label="'Number of episodes'"
            :hasError="$errors->has('movie.number_of_episodes')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.number_of_episodes')"
            wire:model="movie.number_of_episodes"
            value="{{ $movie->number_of_episodes }}"
        ></x-form.input>

        @error('movie.number_of_episodes')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- dependent field -->
    <div class="col-span-1 col-start-3" x-data="{ show: false }" x-show="$wire.movie.film_type == 'SERIES'">
        <x-form.input-trailing
            :print="$print"
            :id="'length_of_episodes'"
            :label="'Average duration of episode'"
            :trailing="'Minutes'"
            :isAmount="false"
            :hasError="$errors->has('movie.length_of_episodes')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.length_of_episodes')"
            wire:model="movie.length_of_episodes"
            value="{{ $movie->length_of_episodes }}"
        ></x-form.input-trailing>

        @error('movie.length_of_episodes')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
</div>
