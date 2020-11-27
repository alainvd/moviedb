<div class="grid grid-cols-3 gap-4">
    <div class="col-span-2 md:col-span-1">
        <label for="start_photography"
            class="block text-sm font-medium leading-5 text-gray-800">Start Date of Principal
            Photography</label>
        <input id="start_photography" wire:model="movie.shooting_start"
            class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            placeholder="dd/mm/yyyy"
            value="{{ \Illuminate\Support\Carbon::parse($movie->shooting_start)->format('d/m/Y') }}">
        @error('movie.shooting_start') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-2 md:col-span-1">
        <label for="end_photography" class="block text-sm font-medium leading-5 text-gray-800">End
            Date of Principal Photography</label>
        <input id="end_photography" wire:model="movie.shooting_end"
            class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            placeholder="dd/mm/yyyy"
            value="{{ \Illuminate\Support\Carbon::parse($movie->shooting_end)->format('d/m/Y') }}">
        @error('movie.shooting_end') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-2 md:col-span-1">
        <label for="shooting_language"
            class="block text-sm font-medium leading-5 text-gray-700">Shooting Language</label>
        <select id="shooting_language"
            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
            @foreach($languages as $lang)
            <option>{{ $lang }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-span-2 md:col-span-1">
        <label for="film_length" class="block text-sm font-medium leading-5 text-gray-800">Film
            Length (in minutes)</label>
        <input id="film_length" wire:model="movie.film_length"
            class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
        @error('movie.film_length') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-2 md:col-span-1">
        <label for="film_format" class="block text-sm font-medium leading-5 text-gray-800">Film
            Format</label>
        <select id="film_format" wire:model="movie.film_format"
            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
            <option>35mm</option>
            <option>Digital</option>
            <option>Other</option>
        </select>
        @error('movie.film_format') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>
</div>
