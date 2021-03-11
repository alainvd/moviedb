<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-basic-vg-prev">

    <div class="col-span-2 mb-4 text-lg">
        General information
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
            :label="'MEDIA Film Nationality'"
            :disabled="$isApplicant"
            :hasError="$errors->has('movie.film_country_of_origin')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.film_country_of_origin')"
            wire:model="movie.film_country_of_origin"
            value="{{ isset($countriesByCode[$movie->film_country_of_origin]) ? $countriesByCode[$movie->film_country_of_origin]['name'] : '' }}"
        >

            @foreach($countries as $country)
                <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
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

    <div class="col-span-2 sm:col-span-1">
        <x-form.select
            :print="$print"
            :id="'film_genre'"
            :label="'Film Genre'"
            :hasError="$errors->has('movie.genre_id')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.genre_id')"
            wire:model="movie.genre_id"
            value="{{ isset($allGenresById[$movie->genre_id]) ? $allGenresById[$movie->genre_id]['name'] : '' }}"
        >

            @foreach($gameGenres as $genre)
                <option value="{{ $genre['id'] }}">{{ $genre['name'] }}</option>
            @endforeach

        </x-form.select>

        @error('media.genre_id')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

</div>
