<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    <div class="col-span-1">
        <x-form.datepicker
            :id="'photography_start'"
            :label="'Start Date of Principal Photography'"
            :hasError="$errors->has('movie.photography_start')"
            wire:model.lazy="movie.photography_start">
        </x-form.datepicker>

        @error('movie.photography_start')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.datepicker
            :id="'end_photography'"
            :label="'End Date of Principal Photography'"
            :hasError="$errors->has('movie.photography_end')"
            wire:model="movie.photography_end">
        </x-form.datepicker>

        @error('movie.photography_end')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
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
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-1">
        <x-form.input
            :id="'film_length'"
            :label="'Film Length (in minutes)'"
            :hasError="$errors->has('movie.film_length')"
            wire:model="movie.film_length">
        </x-form.input>

        @error('movie.film_length')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'film_format'"
            :label="'Film Format'"
            :hasError="$errors->has('movie.film_format')"
            wire:model="movie.film_format">

            @foreach ($filmFormats as $format)
                <option value="{{$format}}">{{$format}}</option>
            @endforeach

        </x-form.select>

        @error('movie.film_format')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>
</div>
