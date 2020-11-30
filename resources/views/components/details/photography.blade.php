<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    <div class="col-span-1">
        <x-form.datepicker
            :id="'start_photography'"
            :label="'Start Date of Principal Photography'"
            wire:model="movie.shooting_start">
        </x-form.datepicker>

        @error('movie.shooting_start')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.datepicker
            :id="'end_photography'"
            :label="'End Date of Principal Photography'"
            wire:model="movie.end_photography">
        </x-form.datepicker>

        @error('movie.shooting_end')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <livewire:chip-autocomplete
            :domId="'shooting_languages'"
            :key="1"
            :label="'Shooting Languages'">
        </livewire:chip-autocomplete>
    </div>

    <div class="col-span-1">
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
            <option>35mm</option>
            <option>Digital</option>
            <option>Other</option>
        </x-form.select>

        @error('movie.film_format')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>
</div>
