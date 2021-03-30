<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-tech-vg">

    <div class="col-span-2 mb-4 text-lg">
        <h3>Technical information</h3>
    </div>

    <div class="col-span-1 sm:col-span-1 md:col-span-1">
        <x-form.input
            :print="$print"
            :id="'gameplay_options'"
            :label="'Gameplay Options'"
            :hasError="$errors->has('movie.gameplay_options')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.gameplay_options')"
            wire:model="movie.gameplay_options"
            value="{{ $movie->gameplay_options }}"
        ></x-form.input>

        @error('movie.gameplay_options')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 sm:col-span-1 md:col-span-1">
        <x-form.input
            :print="$print" 
            :id="'game_modes'"
            :label="'Game Modes'"
            :hasError="$errors->has('movie.game_modes')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.game_modes')"
            wire:model="movie.game_modes"
            value="{{ $movie->game_modes }}"
        ></x-form.input>

        @error('movie.game_modes')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 sm:col-span-1 md:col-span-1">
        <x-form.input
            :print="$print"
            :id="'gaming_platform'"
            :label="'Gaming Platform'"
            :hasError="$errors->has('movie.gaming_platform')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.gaming_platform')"
            wire:model="movie.gaming_platform"
            value="{{ $movie->gaming_platform }}"
        ></x-form.input>

        @error('movie.gaming_platform')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 sm:col-span-1 md:col-span-1">
        <x-form.input
            :print="$print"
            :id="'production_languages'"
            :label="'Production Languages'"
            :hasError="$errors->has('movie.production_languages')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.production_languages')"
            wire:model="movie.production_languages"
            value="{{ $movie->production_languages }}"
        ></x-form.input>

        @error('movie.production_languages')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 sm:col-span-1 md:col-span-1">
        <x-form.input
            :print="$print"
            :id="'localisation_languages'"
            :label="'Localisation Languages'"
            :hasError="$errors->has('movie.localisation_languages')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.localisation_languages')"
            wire:model="movie.localisation_languages"
            value="{{ $movie->localisation_languages }}"
        ></x-form.input>

        @error('movie.localisation_languages')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 sm:col-span-1 md:col-span-1">
        <x-form.input
            :print="$print"
            :id="'game_delivery_media'"
            :label="'Game Delivery Media'"
            :hasError="$errors->has('movie.game_delivery_media')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.game_delivery_media')"
            wire:model="movie.game_delivery_media"
            value="{{ $movie->game_delivery_media }}"
        ></x-form.input>

        @error('movie.game_delivery_media')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>    

</div>
