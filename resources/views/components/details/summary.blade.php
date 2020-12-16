<div class="grid grid-cols-3 gap-4">
    <div class="col-span-3 md:col-span-1">
        <x-form.input
            :id="'imdb'"
            :label="'IMDB URL'"
            :hasError="$errors->has('movie.imdb_url')"
            wire:model="movie.imdb_url">

            &nbsp;&nbsp;
            <a
                target="_blank" href="{{ $movie->imdb_url }}"
                class="tracking-tight text-indigo-600 hover:text-indigo-900">
                    visit
            </a>
        </x-form.input>

        @error('movie.imdb_url')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-3 md:col-span-1">
        <x-form.input
            :id="'ID'"
            :label="'ID'"
            :hasError="$errors->has('movie.isan')"
            wire:model="movie.isan">
        </x-form.input>

        @error('movie.isan')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-3 md:col-span-1 flex items-end">
        <button type="button"
            class="p-3 border border-gray-700 rounded-md shadow-sm text-xs font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
            Manage codes
        </button>
    </div>

    <div class="col-span-3 lg:col-span-2">
        <x-form.textarea
            :id="'synopsis'"
            :label="'Synopsis'"
            :hasError="$errors->has('movie.synopsis')"
            wire:model="movie.synopsis">
        </x-form.textarea>

        @error('movie.synopsis')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>
</div>
