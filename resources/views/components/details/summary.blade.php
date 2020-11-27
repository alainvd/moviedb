<div class="grid grid-cols-3 gap-4">
    <div class="col-span-3 md:col-span-1">
        <x-form.input
            :id="'imdb'"
            :label="'IMDB URL'"
            wire:model="$movie.imdb_url">

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
            wire:model="$movie.id">
        </x-form.input>
    </div>

    <div class="col-span-3 md:col-span-1 flex items-end">
        <button type="button"
            class="p-3 border border-gray-700 rounded-md shadow-sm text-xs font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
            Manage codes
        </button>
    </div>

    <div class="col-span-3 lg:col-span-2">
        <label for="synopsis"
            class="block text-sm font-medium leading-5 text-gray-800">Synopsis</label>
        <div class="rounded-md shadow-sm">
            <textarea id="about" rows="6"
                class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"></textarea>
        </div>
    </div>
</div>
