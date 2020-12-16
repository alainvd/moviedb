<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    <div class="col-span-2 sm:col-span-1 md:col-span-2">
        <x-form.input
            :id="'original_title'"
            :label="'Original Title'"
            wire:model="movie.original_title">

        </x-form.input>

        @error('movie.original_title')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'status'"
            :label="'Status'"
            :disabled="$isApplicant"
            wire:model="fiche.status_id">

            @foreach ($statuses as $status)
                <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
            @endforeach

        </x-form.select>

        @error('fiche.status_id')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'film_country_of_origin'"
            :label="'Country of Origin'"
            wire:model="movie.film_country_of_origin">

            @foreach($countries as $country)
                <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
            @endforeach

        </x-form.select>

        @error('movie.film_country_of_origin')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'copyright'"
            :label="'Copyright'"
            wire:model="movie.year_of_copyright">

            @foreach($years as $year)
                <option value="{{$year}}">{{ $year }}</option>
            @endforeach

        </x-form.select>

        @error('movie.year_of_copyright')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-2 sm:col-span-1">
        <x-form.select
            :id="'film_genre'"
            :label="'Film Genre'"
            wire:model="media.genre_id">

            @foreach($genres as $genre)
                <option value="{{ $genre['id'] }}">{{ $genre['name'] }}</option>
            @endforeach

        </x-form.select>

        @error('media.genre_id')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'delivery_platform'"
            :label="'Film Delivery Platform'"
            wire:model="media.delivery_platform_id">

            @foreach($platforms as $key => $platform)
                <option value="{{$key}}">{{$platform}}</option>
            @endforeach

        </x-form.select>

        @error('media.delivery_platform_id')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'audience'"
            :label="'Audience'"
            wire:model="media.audience_id">

            @foreach ($audiences as $audience)
                <option value="{{ $audience['id'] }}">
                    {{ $audience['name'] }}
                </option>
            @endforeach

        </x-form.select>

        @error('media.audience_id')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'film_type'"
            :label="'Film Type'"
            wire:model="movie.film_type">

            @foreach ($filmTypes as $type)
                <option value="{{$type}}">{{$type}}</option>
            @endforeach

        </x-form.select>

        @error('movie.film_type')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>
</div>
