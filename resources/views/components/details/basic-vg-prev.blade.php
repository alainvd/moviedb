<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-basic-vg-prev">

    <div class="col-span-2 mb-4 text-lg">
        <h3>General information</h3>
    </div>

    <div class="col-span-2 sm:col-span-1 md:col-span-2">
        <x-form.input
            :print="$print"
            :id="'original_title'"
            :label="'Original Title'"
            :hasError="$errors->has('movie.original_title')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.original_title')"
            wire:model="movie.original_title"
            value="{{ $movie->original_title }}"
        ></x-form.input>

        @error('movie.original_title')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :print="$print"
            :id="'status'"
            :label="'Status'"
            :disabled="$isApplicant"
            :hasError="$errors->has('fiche.status_id')"
            :isRequired="FormHelpers::isRequired($rules, 'fiche.status_id')"
            :noEmptyValue="true"
            wire:model="fiche.status_id"
            value="{{ isset($statusesById[$fiche->status_id]) ? $statusesById[$fiche->status_id]['name'] : '' }}"
        >

            @foreach ($statuses as $status)
                <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
            @endforeach

        </x-form.select>

        @error('fiche.status_id')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :print="$print"
            :id="'basic-film_country_of_origin'"
            :label="'Country of Origin'"
            :disabled="$isApplicant"
            :hasError="$errors->has('movie.film_country_of_origin')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.film_country_of_origin')"
            wire:model="movie.film_country_of_origin"
            value="{{ isset($countriesByCode[$movie->film_country_of_origin]) ? $countriesByCode[$movie->film_country_of_origin]['name'] : '' }}"
            :emptyValueLabel="'TBC by EACEA'"
        >

            @foreach ($countriesGrouped as $group=>$countries)
                <optgroup label="---">
                    @foreach ($countries as $country)
                        <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                    @endforeach
                </optgroup>
            @endforeach

        </x-form.select>

        @error('movie.film_country_of_origin')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :print="$print"
            :id="'copyright'"
            :label="'Year of copyright'"
            :hasError="$errors->has('movie.year_of_copyright')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.year_of_copyright')"
            wire:model="movie.year_of_copyright"
            value="{{ $movie->year_of_copyright }}"
        >

            @foreach($years as $year)
                <option value="{{$year}}">{{ $year }}</option>
            @endforeach

        </x-form.select>

        @error('movie.year_of_copyright')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    @if (empty($print))
    <div
        x-data="{ error: {{ $errors->has('movie.game_genres') ? 1 : 0 }} }"
        x-init="$watch('error', value => error == 1 ?
        document.getElementById('game_genres').parentElement.classList.add('border', 'rounded-md', 'border-red-500')
        :
        document.getElementById('game_genres').parentElement.classList.remove('border', 'rounded-md', 'border-red-500')
        )"
        class="col-span-1 col-start-3 sm:col-span-1">
        @livewire('select-component', [
            'ref' => 'choices_game_genres',
            'domId' => 'game-genres',
            'label' => 'Genres/Sub-genres',
            'isRequired' => FormHelpers::isRequired($rules, 'movie.game_genre'),
            'name' => 'gameGenres',
            'options' => json_encode($gameGenresChoices),
            'items' => json_encode($gameGenresSelected),
        ])

        @error('movie.game_genres')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    @endif
    

    <div class="col-span-1">
        <x-form.select
            :print="$print"
            :id="'audience'"
            :label="'Target Audience'"
            :hasError="$errors->has('movie.audience_id')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.audience_id')"
            wire:model="movie.audience_id"
            value="{{ isset($allAudiencesById[$movie->audience_id]) ? $allAudiencesById[$movie->audience_id]['name'] : '' }}"
        >

            @foreach ($gameAudiences as $audience)
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
