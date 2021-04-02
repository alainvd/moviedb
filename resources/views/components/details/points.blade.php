<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-points">
    <div class="col-span-1">
        <x-form.select
            :print="$print"
            :id="'film_country_of_origin'"
            :label="'MEDIA Film Nationality'"
            :hasError="$errors->has('movie.film_country_of_origin')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.film_country_of_origin')"
            wire:model="movie.film_country_of_origin"
            value="{{ isset($countriesByCode[$movie->film_country_of_origin]) ? $countriesByCode[$movie->film_country_of_origin]['name'] : '' }}"
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
            :id="'film_country_of_origin_2014_2020'"
            :label="'MEDIA Film Nationality 2014-2020'"
            :hasError="$errors->has('movie.film_country_of_origin_2014_2020')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.film_country_of_origin_2014_2020')"
            :disabled="true"
            wire:model="movie.film_country_of_origin_2014_2020"
            value="{{ isset($countriesByCode[$movie->film_country_of_origin_2014_2020]) ? $countriesByCode[$movie->film_country_of_origin_2014_2020]['name'] : '' }}"
        >

            @foreach ($countriesGrouped as $group=>$countries)
                <optgroup label="---">
                    @foreach ($countries as $country)
                        <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                    @endforeach
                </optgroup>
            @endforeach

        </x-form.select>

        @error('movie.film_country_of_origin_2014_2020')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.input
            :print="$print"
            :id="'points-country_of_origin_points'"
            :label="'Points for MEDIA Film Nationality'"
            :hasError="$errors->has('movie.country_of_origin_points')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.country_of_origin_points')"
            wire:model="movie.country_of_origin_points"
            placeholder="0.00"
            value="{{ $movie->country_of_origin_points }}"
        ></x-form.input>

        @error('movie.country_of_origin_points')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
</div>
