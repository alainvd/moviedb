<div class="my-16">
    <h3 class="my-4 text-lg font-normal leading-tight">
        Film selection
    </h3>

    <div class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-7">
        <input type="hidden" name="movie_id" wire:model="movie.id">
        @if(empty($print))
        <div class="col-span-1 print:hidden">
            <x-anchors.primary
                class="mt-6"
                :url="route('movie-wizard', ['dossier' => $dossier, 'activity' => 1])"
                :disabled="$dossier->call->closed">
                Search and Select
            </x-anchors.primary>
        </div>
        @endif
        <div class="col-span-2">
            <x-form.input
                :print="$print"
                :id="'film-title'"
                :label="'Film Title'"
                :hasError="$errors->has('film_title')"
                name="film_title"
                :disabled="true"
                wire:model="movie.original_title"
                value="{{ $movie->original_title }}">
            </x-form.input>

            @error('film_title')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-span-1">
            <x-form.input
                :print="$print"
                :id="'director'"
                :label="'Film Director'"
                :disabled="true"
                value="{{ $movie->director }}">
            </x-form.input>
        </div>
        <div class="col-span-1">
            <x-form.input
                :print="$print"
                :id="'country'"
                :label="'Country'"
                :disabled="true"
                wire:model="movie.film_country_of_origin"
                value="{{ $movie->film_country_of_origin }}">
            </x-form.input>
        </div>
        <div class="col-span-1">
            <x-form.input
                :print="$print"
                :id="'copyright'"
                :label="'Year of Copyright'"
                :disabled="true"
                wire:model="movie.year_of_copyright"
                value="{{ $movie->year_of_copyright }}">
            </x-form.input>
        </div>
        @if(empty($print))
        <div class="col-span-1 print:hidden">
            @if($fiche && request()->user()->can('update', $fiche))
            <div class="m-6">
                <x-anchors.secondary :url="route('dist-fiche-form', compact('dossier', 'activity', 'fiche'))" :disabled="$dossier->call->closed">
                    Edit
                </x-anchors.secondary>
            </div>
            @elseif($movie && $movie->fiche)
            <x-button.secondary wire:click.prevent="toggleShowDetails" class="mt-6">
                View details
            </x-button.secondary>
            @endif
        </div>
        @endif
    </div>

    @include('dossiers.movie-details')
</div>
