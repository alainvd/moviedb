<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-photography-dev-prev">

    <div class="col-span-1 col-start-1">
        <x-form.input
            :id="'film_length'"
            :label="'Film Length (in minutes)'"
            :hasError="$errors->has('movie.film_length')"
            wire:model="movie.film_length">
        </x-form.input>

        @error('movie.film_length')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-3 sm:col-span-1">
        <x-form.select
            :id="'shooting-language'"
            :label="'Shooting Language'"
            :hasError="$errors->has('shootingLanguage')"
            wire:model="shootingLanguage">

            @foreach ($languages as $language)
                <option value="{{ $language['value'] }}">{{$language['label']}}</option>
            @endforeach

        </x-form.select>

        @error('shootingLanguage')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'audience'"
            :label="'Targeted Audience'"
            :hasError="$errors->has('media.audience_id')"
            wire:model="media.audience_id">

            @foreach ($audiences as $audience)
                <option value="{{ $audience['id'] }}">
                    {{ $audience['name'] }}
                </option>
            @endforeach

        </x-form.select>

        @error('media.audience_id')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

</div>
