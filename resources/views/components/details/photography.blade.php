<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-photography">

    @if($isEditor)
    <div class="col-span-2 mb-4 text-lg">
        Technical information
    </div>
    @endif

    <div class="col-span-1 col-start-1">
        <x-form.datepicker
            :id="'photography_start'"
            :label="'Start Date of Principal Photography'"
            :hasError="$errors->has('movie.photography_start')"
            wire:model.lazy="movie.photography_start">
        </x-form.datepicker>

        @error('movie.photography_start')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-2">
        <x-form.datepicker
            :id="'photography_end'"
            :label="'End Date of Principal Photography'"
            :hasError="$errors->has('movie.photography_end')"
            wire:model="movie.photography_end">
        </x-form.datepicker>

        @error('movie.photography_end')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-3 sm:col-span-1">
        @livewire('select-component', [
            'domId' => 'shooting-language',
            'label' => 'Shooting language',
            'name' => 'shootingLanguage',
            'options' => json_encode($languages),
            'items' => json_encode($languagesSelected)
        ])
    </div>

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

    <div class="col-span-1">
        <x-form.select
            :id="'film_format'"
            :label="'Film Format'"
            :hasError="$errors->has('movie.film_format')"
            wire:model="movie.film_format">

            @foreach ($filmFormats as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach

        </x-form.select>

        @error('movie.film_format')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
</div>
