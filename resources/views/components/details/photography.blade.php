<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    <div class="col-span-1">
        <x-form.datepicker
            :id="'photography_start'"
            :label="'Start Date of Principal Photography'"
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
            wire:model="movie.photography_end">
        </x-form.datepicker>

        @error('movie.photography_end')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-3 sm:col-span-1">
        @livewire('select-component', [
            'domId' => 'shooting-languages',
            'label' => 'Shooting languages',
            'name' => 'shootingLanguages',
            'options' => json_encode($languages),
        ])
    </div>

    <div class="col-span-1 col-start-1">
        <x-form.input
            :id="'film_length'"
            :label="'Film Length (in minutes)'"
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
