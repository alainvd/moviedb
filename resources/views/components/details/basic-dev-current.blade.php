<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-basic-dev-current">

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
            value="{{ $statusesById[$fiche->status_id]['name'] }}"
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
            :id="'audience'"
            :label="'Primary Audience'"
            :hasError="$errors->has('movie.audience_id')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.audience_id')"
            wire:model="movie.audience_id"
            value="{{ isset($allAaudiencesById[$movie->audience_id]) ? $allAaudiencesById[$movie->audience_id]['name'] : '' }}"
        >

            @foreach ($movieAudiences as $audience)
                <option value="{{ $audience['id'] }}">
                    {{ $audience['name'] }}
                </option>
            @endforeach

        </x-form.select>

        @error('movie.audience_id')
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

            @foreach($movieGenres as $genre)
                <option value="{{ $genre['id'] }}">{{ $genre['name'] }}</option>
            @endforeach

        </x-form.select>

        @error('movie.genre_id')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :print="$print"
            :id="'delivery_platform'"
            :label="'Film Delivery Platform'"
            :hasError="$errors->has('movie.delivery_platform')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.delivery_platform')"
            wire:model="movie.delivery_platform"
            value="{{ isset($platforms[$movie->delivery_platform]) ? $platforms[$movie->delivery_platform] : '' }}"
        >

            @foreach($platforms as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach

        </x-form.select>

        @error('movie.delivery_platform')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :print="$print"
            :id="'user_experience'"
            :label="'User Experience'"
            :hasError="$errors->has('movie.user_experience')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.user_experience')"
            wire:model="movie.user_experience"
            value="{{ isset($userExperiences[$movie->user_experience]) ? $userExperiences[$movie->user_experience] : '' }}"
        >

            @foreach($userExperiences as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach

        </x-form.select>

        @error('movie.user_experience')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :print="$print"
            :id="'film_type'"
            :label="'Film Type'"
            :hasError="$errors->has('movie.film_type')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.film_type')"
            wire:model="movie.film_type"
            value="{{ isset($filmTypes[$movie->film_type]) ? $filmTypes[$movie->film_type] : '' }}"
        >

            @foreach ($filmTypes as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach

        </x-form.select>

        @error('movie.film_type')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

</div>
