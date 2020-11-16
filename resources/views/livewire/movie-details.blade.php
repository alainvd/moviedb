<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <div class="flex-1 min-w-0 flex flex-row justify-between">
            <div>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9">
                    MDB{{ $movie->year_of_copyright }}/{{ $movie->id }} - {{ $movie->original_title }}
                </h2>
            </div>
            <div class="text-gray-600 inline-block align-baseline mt-3">
                Modified on 7 January 2020 by John Smith
            </div>
        </div>
    </div>

    <div class="flex flex-col mt-4 px-0 sm:px-4">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 bg-white p-4 sm:p-10">
                <div class="grid grid-cols-8 gap-6">
                    <div class="col-start-1 col-span-6">
                        <label for="original_title"
                            class="block text-sm font-medium leading-5 text-gray-800">Original Title</label>
                        <input id="original_title"
                            class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            value="{{ $movie->original_title }}">
                    </div>

                    <div class="col-start-7 col-end-9">
                        <label for="status" class="block text-sm font-medium leading-5 text-gray-700">European Flag Status</label>
                        <select id="status"
                            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option>OK</option>
                            <option>Under Processing</option>
                            <option>Not OK</option>
                            <option>Missing information</option>
                        </select>
                    </div>

                    <div class="col-start-1 col-span-2">
                        <label for="nationality" class="block text-sm font-medium leading-5 text-gray-700">Country of Origin</label>
                        <select id="nationality"
                            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            @foreach($countries as $country_code => $country_name)
                                @if($country_code == $movie->film_country_of_origin)
                                    <option selected value="{{ $country_code }}">{{ $country_name }}</option>
                                @else
                                    <option value="{{ $country_code }}">{{ $country_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-start-4 col-span-2">
                        <label for="copyright"
                            class="block text-sm font-medium leading-5 text-gray-700">Copyright</label>
                        <select id="copyright"
                            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            @foreach($years as $year)
                                @if($year == $movie->year_of_copyright)
                                    <option selected>{{ $year }}</option>
                                @else
                                    <option>{{ $year }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-start-7 col-span-2">
                        <label for="film_genre" class="block text-sm font-medium leading-5 text-gray-700">Film Genre</label>
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
                        <label for="film_type" class="block text-sm font-medium leading-5 text-gray-700">Film Type</label>
                        <select id="film_type"
                            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option>One-off</option>
                            <option>Series</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-9 gap-6 mt-16">
                    <div class="col-start-1 col-span-4">
                        <label for="imdb" class="block text-sm font-medium leading-5 text-gray-800">IMDB URL - <a
                                target="_blank" href="{{ $movie->imdb_url }}"
                                class="text-indigo-600 hover:text-indigo-900">Visit</a></label>
                        <input id="original_title"
                            class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            value="{{ $movie->imdb_url }}">
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

                <hr class="mt-10 mb-10">

                <x-table-user :title="'Cast'" :users="$cast"></x-table-user>

                <hr class="mt-10 mb-10">

                <x-table-user :title="'Crew'" :users="$crew"></x-table-user>

                <div class="grid grid-cols-9 gap-6 my-12">
                    <div class="col-start-1 col-span-3">
                        <label for="start_photography"
                            class="block text-sm font-medium leading-5 text-gray-800">Start Date of Principal Photography</label>
                        <input id="start_photography"
                            class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            placeholder="dd/mm/yyyy"
                            value="{{ \Illuminate\Support\Carbon::parse($movie->shooting_start)->format('d/m/Y') }}">
                    </div>

                    <div class="col-start-4 col-span-3">
                        <label for="end_photography" class="block text-sm font-medium leading-5 text-gray-800">End Date of Principal Photography</label>
                        <input id="end_photography"
                            class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            placeholder="dd/mm/yyyy"
                            value="{{ \Illuminate\Support\Carbon::parse($movie->shooting_end)->format('d/m/Y') }}">
                    </div>

                    <div class="col-start-7 col-span-3">
                        <label for="shooting_language"
                            class="block text-sm font-medium leading-5 text-gray-700">Shooting Language</label>
                        <select id="shooting_language"
                            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            @foreach($languages as $lang)
                                <option>{{ $lang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-start-1 col-span-3">
                        <label for="film_length" class="block text-sm font-medium leading-5 text-gray-800">Film Length (in minutes)</label>
                        <input id="film_length"
                            class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    </div>

                    <div class="col-start-4 col-span-3">
                        <label for="film_format" class="block text-sm font-medium leading-5 text-gray-800">Film Format</label>
                        <select id="film_format"
                            class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option>35mm</option>
                            <option>Digital</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>

                <x-table-producer></x-table-producer>

                <hr class="mt-10 mb-10">

                <x-table-sales></x-table-sales>

                <div class="flex mt-12 justify-end">
                    <span class="inline-flex rounded-md shadow-sm mr-8">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                            Save Changes
                        </button>
                    </span>

                    <span class="inline-flex rounded-md shadow-sm">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 border border-gray-600 text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-indigo-50 focus:outline-none focus:border-gray-600 focus:shadow-outline-indigo active:bg-indigo-200 transition ease-in-out duration-150">
                            Discard
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
