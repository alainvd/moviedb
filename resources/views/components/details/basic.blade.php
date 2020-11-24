<div class="grid grid-cols-8 gap-6">
    <div class="col-start-1 col-span-6">
        <label for="original_title"
            class="block text-sm font-medium leading-5 text-gray-800">Original Title (wired)</label>
        <input id="original_title" wire:model="movie.original_title"
            class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
        @error('movie.original_title') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-start-7 col-end-9">
        <label for="status" class="block text-sm font-medium leading-5 text-gray-700">European Flag
            Status (wired)</label>
        <select id="status" wire:model="movie.european_nationality_flag"
            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
            <option>OK</option>
            <option>Under Processing</option>
            <option>Not OK</option>
            <option>Missing information</option>
        </select>
        @error('movie.european_nationality_flag') <div class="mt-1 text-red-500 text-sm">
            {{ $message }}</div> @enderror
    </div>

    <div class="col-start-1 col-span-2">
        <label for="nationality" class="block text-sm font-medium leading-5 text-gray-700">Country
            of Origin (wired)</label>
        <select id="nationality" wire:model="movie.film_country_of_origin"
            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
            @foreach($countries as $country_code => $country_name)
            <option value="{{ $country_code }}">{{ $country_name }}</option>
            @endforeach
        </select>
        @error('movie.film_country_of_origin') <div class="mt-1 text-red-500 text-sm">{{ $message }}
        </div> @enderror
    </div>

    <div class="col-start-4 col-span-2">
        <label for="copyright" class="block text-sm font-medium leading-5 text-gray-700">Copyright
            (wired)</label>
        <select id="copyright" wire:model="movie.year_of_copyright"
            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
            @foreach($years as $year)
            <option>{{ $year }}</option>
            @endforeach
        </select>
        @error('movie.year_of_copyright') <div class="mt-1 text-red-500 text-sm">{{ $message }}
        </div> @enderror
    </div>

    <div class="col-start-7 col-span-2">
        <label for="film_genre" class="block text-sm font-medium leading-5 text-gray-700">Film
            Genre</label>
        <select id="film_genre"
            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
            @foreach($genres as $genre)
            <option>{{ $genre }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-start-1 col-span-2">
        <label for="delivery_platform"
            class="block text-sm font-medium leading-5 text-gray-700">Film Delivery Platform</label>
        <select id="delivery_platform"
            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
            <option>Features / Cinema</option>
            <option>TV</option>
            <option>Digital</option>
        </select>
    </div>

    <div class="col-start-4 col-span-2">
        <label for="audience"
            class="block text-sm font-medium leading-5 text-gray-700">Audience</label>
        <select id="audience"
            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
            <option>All</option>
            <option>Children</option>
            <option selected>Adults</option>
        </select>
    </div>

    <div class="col-start-7 col-span-2">
        <label for="film_type" class="block text-sm font-medium leading-5 text-gray-700">Film Type
            (wired)</label>
        <select id="film_type" wire:model="movie.film_type"
            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
            <option>One-off</option>
            <option>Series</option>
        </select>
        @error('movie.film_type') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>
</div>