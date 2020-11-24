<div class="grid grid-cols-9 gap-6 mt-16">
    <div class="col-start-1 col-span-4">
        <label for="imdb" class="block text-sm font-medium leading-5 text-gray-800">IMDB URL - <a
                target="_blank" href="{{ $movie->imdb_url }}"
                class="text-indigo-600 hover:text-indigo-900">Visit</a> (wired)</label>
        <input id="imdb_url" wire:model="movie.imdb_url"
            class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            value="{{ $movie->imdb_url }}">
        @error('movie.imdb_url') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-start-5 col-span-4">
        <label for="ID" class="block text-sm font-medium leading-5 text-gray-800">ID</label>
        <input id="ID"
            class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
    </div>

    <div class="col-start-9 col-span-2 mt-6">
        <span class="ml-5 rounded-md shadow-sm">
            <button type="button"
                class="mt-1 py-2 px-3 border border-gray-700 rounded-md text-xs leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                Manage codes
            </button>
        </span>
    </div>

    <div class="col-start-1 col-span-9">
        <label for="synopsis"
            class="block text-sm font-medium leading-5 text-gray-800">Synopsis</label>
        <div class="mt-1 rounded-md shadow-sm">
            <textarea id="about" rows="6"
                class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"></textarea>
        </div>
    </div>
</div>