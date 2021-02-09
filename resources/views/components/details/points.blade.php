<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-points">
    <div class="col-span-1">
        <x-form.select
            :id="'film_country_of_origin'"
            :label="'Country of Origin'"
            :hasError="$errors->has('movie.film_country_of_origin')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.film_country_of_origin')"
            wire:model="movie.film_country_of_origin">

            @foreach($countries as $country)
                <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
            @endforeach

        </x-form.select>

        @error('movie.film_country_of_origin')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.input
            :id="'points-country_of_origin_points'"
            :label="'Points for Country of Origin'"
            :hasError="$errors->has('movie.country_of_origin_points')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.country_of_origin_points')"
            wire:model="movie.country_of_origin_points"
            placeholder="0.00">

        </x-form.input>

        @error('movie.country_of_origin_points')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
</div>
