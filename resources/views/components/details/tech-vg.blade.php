<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-tech-vg">

    <div class="col-span-2 mb-4 text-lg sm:col-span-2 md:col-span-3">
        <h3>Technical information</h3>
    </div>

    @if (empty($print))
    <div
        x-data="{ error: {{ $errors->has('movie.gameplay_options') ? 1 : 0 }} }"
        x-init="$watch('error', value => error == 1 ?
        document.getElementById('gameplay_options').parentElement.classList.add('border', 'rounded-md', 'border-red-500')
        :
        document.getElementById('gameplay_options').parentElement.classList.remove('border', 'rounded-md', 'border-red-500')
        )"
        class="col-span-1 col-start-1 sm:col-start-1 md:col-start-1">
        @livewire('select-component', [
            'ref' => 'choices_gameplay_options',
            'domId' => 'gameplay-option',
            'label' => 'Gameplay Options',
            'isRequired' => FormHelpers::isRequired($rules, 'movie.gameplay_options'),
            'name' => 'gameOptions',
            'options' => json_encode($gameOptionsChoices),
            'items' => json_encode($gameOptionsSelected),
        ])

        @error('movie.game_options')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    @endif

    @if (!empty($print))
    <span class="font-bold">Gameplay Options</span>
    <span>{{ $gameOptionsSelected->implode('label', ', ') }}</span>
    @endif

    @if (empty($print))
    <div
        x-data="{ error: {{ $errors->has('movie.game_modes') ? 1 : 0 }} }"
        x-init="$watch('error', value => error == 1 ?
        document.getElementById('game_modes').parentElement.classList.add('border', 'rounded-md', 'border-red-500')
        :
        document.getElementById('game_modes').parentElement.classList.remove('border', 'rounded-md', 'border-red-500')
        )"
        class="col-span-1 col-start-3 sm:col-span-1">
        @livewire('select-component', [
            'ref' => 'choices_game_modes',
            'domId' => 'game-mode',
            'label' => 'Game Modes',
            'isRequired' => FormHelpers::isRequired($rules, 'movie.gameplay_options'),
            'name' => 'gameModes',
            'options' => json_encode($gameModesChoices),
            'items' => json_encode($gameModesSelected),
        ])

        @error('movie.game_modes')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    @endif

    @if (!empty($print))
    <span class="font-bold">Game Modes</span>
    <span>{{ $gameModesSelected->implode('label', ', ') }}</span>
    @endif

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

    @if (empty($print))
    <div
        x-data="{ error: {{ $errors->has('movie.shooting_languages') ? 1 : 0 }} }"
        x-init="$watch('error', value => error == 1 ?
        document.getElementById('shooting_languages').parentElement.classList.add('border', 'rounded-md', 'border-red-500')
        :
        document.getElementById('shooting_languages').parentElement.classList.remove('border', 'rounded-md', 'border-red-500')
        )"
        class="col-span-1 col-start-3 sm:col-span-1">
        @livewire('select-component', [
            'ref' => 'choices_shooting_languages',
            'domId' => 'shooting-language',
            'label' => 'Localisation Languages',
            'isRequired' => FormHelpers::isRequired($rules, 'movie.shooting_language'),
            'name' => 'shootingLanguages',
            'options' => json_encode($languagesGroupedChoices),
            'items' => json_encode($languagesSelected),
        ])

        @error('movie.shooting_languages')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    @endif
    
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
