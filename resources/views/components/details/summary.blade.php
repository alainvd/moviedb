<div class="grid grid-cols-3 gap-4 fiche-details-component" id="fdc-summary">

    <div class="col-span-3 md:col-span-1">
        <x-form.input
            :print="$print"
            :id="'imdb'"
            :label="'IMDB link'"
            :hasError="$errors->has('movie.imdb_url')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.imdb_url')"
            wire:model="movie.imdb_url"
            value="{{ $movie->imdb_url }}">

            &nbsp;&nbsp;
            @if (empty($print))
            <a x-data="{ show: {{ !empty($movie->imdb_url) ? 1 : 0 }} }" x-show="show"
                target="_blank" href="{{ $movie->imdb_url }}"
                class="tracking-tight text-indigo-600 hover:text-indigo-900 print:hidden">
                    visit
            </a>
            @endif
        </x-form.input>

        @error('movie.imdb_url')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-3 md:col-span-1">
        <x-form.input
            :print="$print"
            :id="'isan'"
            :label="'ISAN'"
            :hasError="$errors->has('movie.isan')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.isan')"
            wire:model="movie.isan"
            value="{{ $movie->isan }}">
        </x-form.input>

        @error('movie.isan')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-3 lg:col-span-3">
        <x-form.textarea
            :print="$print"
            :id="'synopsis'"
            :label="'Synopsis'"
            :hasError="$errors->has('movie.synopsis')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.synopsis')"
            wire:model="movie.synopsis"
            value="{{ $movie->synopsis }}">
        </x-form.textarea>

        @error('movie.synopsis')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    
</div>
