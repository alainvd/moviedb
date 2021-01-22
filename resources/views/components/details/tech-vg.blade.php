<div class="mb-8 text-lg">
        Technical Information
    </div>

<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="tech-prev">



   

    <div class="col-span-1 sm:col-span-1 md:col-span-1">
        <x-form.input
            :id="'gameplay_options'"
            :label="'Gameplay Options'"
            :hasError="$errors->has('movie.gameplay_options')"
            wire:model="movie.gameplay_options">

        </x-form.input>

        @error('movie.gameplay_options')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 sm:col-span-1 md:col-span-1">
        
            @livewire('select-component', [
                'domId' => 'game_modes',
                'label' => 'Game Modes',
                'name' => 'game_modes',
                'options' => json_encode($modes),
                'items' => json_encode($modesSelected)
            ])
        
    </div>

    <div class="col-span-1 sm:col-span-1 md:col-span-1">
        
            @livewire('select-component', [
                'domId' => 'gaming_platform',
                'label' => 'Gaming Platform',
                'name' => 'gaming_platform',
                'options' => json_encode($languages),
                'items' => json_encode($languagesSelected)
            ])

        
    </div>

    <div class="col-span-1 sm:col-span-1 md:col-span-1">
        <x-form.input
            :id="'production_languages'"
            :label="'Production Languages'"
            :hasError="$errors->has('movie.production_languages')"
            wire:model="movie.production_languages">

        </x-form.input>

        @error('movie.production_languages')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 sm:col-span-1 md:col-span-1">
        <x-form.input
            :id="'localisation_languages'"
            :label="'Localisation Languages'"
            :hasError="$errors->has('movie.localisation_languages')"
            wire:model="movie.localisation_languages">

        </x-form.input>

        @error('movie.localisation_languages')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 sm:col-span-1 md:col-span-1">
        <x-form.input
            :id="'game_delivery_media'"
            :label="'Game Delivery Media'"
            :hasError="$errors->has('movie.game_delivery_media')"
            wire:model="movie.game_delivery_media">

        </x-form.input>

        @error('movie.game_delivery_media')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>


    

</div>
