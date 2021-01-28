<div class="my-16">
    <h3 class="text-lg leading-tight font-normal my-4">
        Film selection
    </h3>

    <div class="grid grid-cols-6 gap-4">
        <input type="hidden" name="movie_id" wire:model="movie.id">
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
                :id="'country'"
                :label="'Country'"
                :disabled="true"
                wire:model="movie.film_country_of_origin">
            </x-form.input>
        </div>
        <div class="col-span-1">
            <x-form.input
                :id="'copyright'"
                :label="'Copyright'"
                :disabled="true"
                wire:model="movie.year_of_copyright">
            </x-form.input>
        </div>
        <div class="col-span-2 ml-auto">
            <x-button.secondary class="mt-6">
                View details
            </x-button.secondary>
            <x-anchors.secondary
                :url="route('movie-wizard', ['dossier' => $dossier])">
                Select
            </x-anchors.secondary>
        </div>
    </div>
</div>
