<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-basic-dev-prev">
    <div class="col-span-2 sm:col-span-1 md:col-span-2">
        <x-form.input
            :id="'original_title'"
            :label="'Original Title'"
            :hasError="$errors->has('movie.original_title')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.original_title')"
            wire:model="movie.original_title">

        </x-form.input>

        @error('movie.original_title')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'status'"
            :label="'Status'"
            :disabled="$isApplicant"
            :hasError="$errors->has('fiche.status_id')"
            :isRequired="FormHelpers::isRequired($rules, 'fiche.status_id')"
            wire:model="fiche.status_id">

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
            :id="'basic-film_country_of_origin'"
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
        <x-form.select
            :id="'copyright'"
            :label="'Copyright'"
            :hasError="$errors->has('movie.year_of_copyright')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.year_of_copyright')"
            wire:model="movie.year_of_copyright">

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
            :id="'film_genre'"
            :label="'Film Genre'"
            :hasError="$errors->has('media.genre_id')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.genre_id')"
            wire:model="media.genre_id">

            @foreach($genres as $genre)
                <option value="{{ $genre['id'] }}">{{ $genre['name'] }}</option>
            @endforeach

        </x-form.select>

        @error('media.genre_id')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

</div>
