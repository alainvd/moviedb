<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-photography-dev-prev">

    <div class="col-span-1 col-start-1">
        <x-form.input
            :id="'film_length'"
            :label="'Film Length (in minutes)'"
            :hasError="$errors->has('movie.film_length')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.film_length')"
            wire:model="movie.film_length">
        </x-form.input>

        @error('movie.film_length')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
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
        <x-form.select
            :id="'audience'"
            :label="'Targeted Audience'"
            :hasError="$errors->has('movie.audience_id')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.audience_id')"
            wire:model="movie.audience_id">

            @foreach ($audiences as $audience)
                <option value="{{ $audience['id'] }}">
                    {{ $audience['name'] }}
                </option>
            @endforeach

        </x-form.select>

        @error('movie.audience_id')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

</div>
