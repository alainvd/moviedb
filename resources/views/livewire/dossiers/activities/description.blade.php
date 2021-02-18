<div class="my-16">
    <h3 class="text-lg leading-tight font-normal my-4">
        Film selection
    </h3>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
        <input type="hidden" name="movie_id" wire:model="movie.id">
        <div class="col-span-1">
            <x-anchors.primary
                class="mt-6"
                :url="route('movie-wizard', ['dossier' => $dossier])">
                Search and Select
            </x-anchors.primary>
        </div>
        <div class="col-span-2">
            <x-form.input
                :id="'film-title'"
                :label="'Film Title'"
                :hasError="$errors->has('film_title')"
                name="film_title"
                :readonly="true"
                wire:model="movie.original_title">
            </x-form.input>

            @error('film_title')
                <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-span-1">
            <x-form.input
                :id="'director'"
                :label="'Film Director'"
                :disabled="true"
                wire:model="movie.director">
            </x-form.input>
        </div>
        <div class="col-span-1">
            <x-form.input
                :id="'country'"
                :label="'Country'"
                :disabled="true"
                wire:model="movie.film_country_of_origin">
            </x-form.input>
        </div>
        <div class="col-span-1">
            <x-form.input
                :id="'copyright'"
                :label="'Year of Copyright'"
                :disabled="true"
                wire:model="movie.year_of_copyright">
            </x-form.input>
        </div>
        <div class="col-span-1">
            <x-button.secondary class="mt-6">
                View details
            </x-button.secondary>
        </div>
    </div>
</div>
