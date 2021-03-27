<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-tech">

    <div class="col-span-2 mb-4 text-lg">
        <h3>Technical information</h3>
    </div>

    <div class="col-span-1 col-start-1">
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

    <div class="col-span-1 col-start-2">
        <x-form.datepicker
            :print="$print"
            :id="'photography_end'"
            :label="'End Date of Principal Photography'"
            :hasError="$errors->has('movie.photography_end')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.photography_end')"
            wire:model.lazy="movie.photography_end"
            value="{{ $movie->photography_end }}"
        ></x-form.datepicker>

        @error('movie.photography_end')
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
            'options' => json_encode($languagesValueLabel),
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

    <div class="col-span-1 col-start-1">
        <x-form.input
            :print="$print"
            :id="'film_length'"
            :label="'Film Length (in minutes)'"
            :hasError="$errors->has('movie.film_length')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.film_length')"
            wire:model="movie.film_length"
            value="{{ $movie->film_length }}"
        ></x-form.input>

        @error('movie.film_length')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :print="$print"            
            :id="'film_format'"
            :label="'Film Format'"
            :hasError="$errors->has('movie.film_format')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.film_format')"
            wire:model="movie.film_format"
            value="{{ $movie->film_format }}"
        >

            @foreach ($filmFormats as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach

        </x-form.select>

        @error('movie.film_format')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
</div>
