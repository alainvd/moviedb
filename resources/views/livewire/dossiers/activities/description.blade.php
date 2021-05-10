<div class="my-16">
    <h3 class="my-4 text-lg font-normal leading-tight">
        Film selection
    </h3>

    <div class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-7">
        <input type="hidden" name="movie_id" wire:model="movie.id">
        @if(empty($print))
        <div class="col-span-1 print:hidden">
            <x-anchors.primary
                class="mt-6"
                :url="route('movie-wizard', ['dossier' => $dossier, 'activity' => 1])">
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
                :readonly="true"
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
            <x-button.secondary wire:click.prevent="toggleShowDetails" class="mt-6">
                View details
            </x-button.secondary>
        </div>
        @endif
    </div>

    <x-modal.dialog wire:model="showDetailsModal">
        <x-slot name="title">
            Movie details
        </x-slot>

        <x-slot name="content">
            @if ($movie->id)
                <div class="grid grid-cols-3 gap-4 px-16 my-8">
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                            Original title
                        </label>
                        <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                            {{ $movie->original_title }}
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                            Status
                        </label>
                        <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                            {{ $movie->fiche->status->name }}
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                            Country of origin
                        </label>
                        <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                            {{ $movie->film_country_of_origin }}
                        </div>
                    </div>
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                            Copyright
                        </label>
                        <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                            {{ $movie->year_of_copyright }}
                        </div>
                    </div>
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                            Film genre
                        </label>
                        <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                            {{ $movie->genre->name }}
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                            Audience
                        </label>
                        <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                            {{ $movie->audience->name }}
                        </div>
                    </div>
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                            Film type
                        </label>
                        <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                            {{ $movie->film_type }}
                        </div>
                    </div>

                    <div class="col-span-3">
                        <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                            Synopsis
                        </label>
                        <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                            {{ $movie->synopsis }}
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                            Film director
                        </label>
                        <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                            {{ $movie->director }}
                        </div>
                    </div>
                </div>
            @endif

            <x-slot name="footer">
                <x-button.primary wire:click="$set('showDetailsModal', false)">
                    OK
                </x-button.primary>
            </x-slot>
        </x-slot>
    </x-modal.dialog>
</div>
