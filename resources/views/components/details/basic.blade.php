<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    <div class="col-span-2 sm:col-span-1 md:col-span-2">
        <label for="original_title" class="block text-sm font-light leading-5 text-gray-800">Original Title (wired)</label>
        <input id="original_title" wire:model="movie.original_title" class="mt-1 form-input block w-full md:w-10/12 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
        @error('movie.original_title') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'status'"
            :label="'European Flag Status (wired)'"
            wire:model="movie.european_nationality_flag">

            <option>OK</option>
            <option>Under Processing</option>
            <option>Not OK</option>
            <option>Missing information</option>

        </x-form.select>

        @error('movie.european_nationality_flag')
        <div class="mt-1 text-red-500 text-sm">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'nationality'"
            :label="'Country of Origin (wired)'"
            wire:model="movie.film_country_of_origin">

            @foreach($countries as $country_code => $country_name)
                <option value="{{ $country_code }}">{{ $country_name }}</option>
            @endforeach

        </x-form.select>

        @error('movie.film_country_of_origin')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'copyright'"
            :label="'Copyright'"
            wire:model="movie.year_of_copyright">

            @foreach($years as $year)
                <option>{{ $year }}</option>
            @endforeach

        </x-form.select>

        @error('movie.year_of_copyright')
        <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-2 sm:col-span-1">
        <x-form.select
            :id="'film_genre'"
            :label="'Film Genre'"
            wire:model="movie.film_genre">

            @foreach($genres as $genre)
                <option>{{ $genre }}</option>
            @endforeach

        </x-form.select>
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'delivery_platform'"
            :label="'Film Delivery Platform'"
            wire:model="movie.delivery_platform">

            <option>Features / Cinema</option>
            <option>TV</option>
            <option>Digital</option>

        </x-form.select>
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'audience'"
            :label="'Audience'"
            wire:model="movie.audience">

            <option>All</option>
            <option>Children</option>
            <option selected>Adults</option>

        </x-form.select>
    </div>

    <div class="col-span-1">
        <x-form.select
            :id="'film_type'"
            :label="'Film Type'"
            wire:model="movie.film_type">

            <option>One-off</option>
            <option>Series</option>

        </x-form.select>

        @error('movie.film_type')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>
</div>
