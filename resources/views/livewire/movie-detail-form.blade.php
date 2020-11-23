<div>
    <form wire:submit.prevent="save">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="flex-1 min-w-0 flex flex-row justify-between">
                <div>
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9">
                        MDB{{ $movie->year_of_copyright }}/{{ $movie->id }} - {{ $movie->original_title }}
                    </h2>
                </div>
                <div class="text-gray-600 inline-block align-baseline mt-3">
                    Modified on {{-- $movie->updated_at->format('d F Y') --}} by John Smith
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
                                class="block text-sm font-medium leading-5 text-gray-800">Original Title (wired)</label>
                            <input id="original_title"
                                wire:model="movie.original_title"
                                class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            @error('movie.original_title') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-start-7 col-end-9">
                            <label for="status" class="block text-sm font-medium leading-5 text-gray-700">European Flag Status (wired)</label>
                            <select id="status"
                                wire:model="movie.european_nationality_flag"
                                class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <option>OK</option>
                                <option>Under Processing</option>
                                <option>Not OK</option>
                                <option>Missing information</option>
                            </select>
                            @error('movie.european_nationality_flag') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-start-1 col-span-2">
                            <label for="nationality" class="block text-sm font-medium leading-5 text-gray-700">Country of Origin (wired)</label>
                            <select id="nationality"
                                wire:model="movie.film_country_of_origin"
                                class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                @foreach($countries as $country_code => $country_name)
                                    <option value="{{ $country_code }}">{{ $country_name }}</option>
                                @endforeach
                            </select>
                            @error('movie.film_country_of_origin') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-start-4 col-span-2">
                            <label for="copyright"
                                class="block text-sm font-medium leading-5 text-gray-700">Copyright (wired)</label>
                            <select id="copyright"
                                wire:model="movie.year_of_copyright"
                                class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                @foreach($years as $year)
                                    <option>{{ $year }}</option>
                                @endforeach
                            </select>
                            @error('movie.year_of_copyright') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
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
                            <label for="film_type" class="block text-sm font-medium leading-5 text-gray-700">Film Type (wired)</label>
                            <select id="film_type"
                                wire:model="movie.film_type"
                                class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <option>One-off</option>
                                <option>Series</option>
                            </select>
                            @error('movie.film_type') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-9 gap-6 mt-16">
                        <div class="col-start-1 col-span-4">
                            <label for="imdb" class="block text-sm font-medium leading-5 text-gray-800">IMDB URL - <a
                                    target="_blank" href="{{ $movie->imdb_url }}"
                                    class="text-indigo-600 hover:text-indigo-900">Visit</a> (wired)</label>
                            <input id="imdb_url"
                                wire:model="movie.imdb_url"
                                class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                value="{{ $movie->imdb_url }}">
                            @error('movie.imdb_url') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
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

                    {{--<x-table-user :title="'Cast'" :users="$cast"></x-table-user>--}}

                    <hr class="mt-10 mb-10">

                    {{--<x-table-user :title="'Crew'" :users="$crew"></x-table-user>--}}

                    <hr class="mt-10 mb-10">

                    <div>
                        <h3>Table with people (work in progress)</h3>
                        <table>
                        @foreach ($peopleOnForm as $person)
                            <tr wire:key="{{ $person['key'] }}">
                                <td>{{ $person['first_name'] }}</td>
                                <td>{{ $person['last_name'] }}</td>
                                <td><a wire:click="showModalEdit('{{ $person['key'] }}')">Edit</a></td>
                                <td><a wire:click="showModalDelete('{{ $person['key'] }}')">Delete</a></td>
                            </tr>
                        @endforeach
                        </table>
                    </div>

                    <div class="mt-5">
                        <a wire:click="showModalAdd" wire:loading.attr="disabled">
                            Add person
                        </a>
                    </div>

                    <div class="grid grid-cols-9 gap-6 my-12">
                        <div class="col-start-1 col-span-3">
                            <label for="start_photography"
                                class="block text-sm font-medium leading-5 text-gray-800">Start Date of Principal Photography (wired, todo)</label>
                            <input id="start_photography"
                                wire:model="movie.shooting_start"
                                class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                placeholder="dd/mm/yyyy"
                                value="{{ \Illuminate\Support\Carbon::parse($movie->shooting_start)->format('d/m/Y') }}">
                            @error('movie.shooting_start') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-start-4 col-span-3">
                            <label for="end_photography" class="block text-sm font-medium leading-5 text-gray-800">End Date of Principal Photography (wired, todo)</label>
                            <input id="end_photography"
                                wire:model="movie.shooting_end"
                                class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                placeholder="dd/mm/yyyy"
                                value="{{ \Illuminate\Support\Carbon::parse($movie->shooting_end)->format('d/m/Y') }}">
                            @error('movie.shooting_end') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
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
                            <label for="film_length" class="block text-sm font-medium leading-5 text-gray-800">Film Length (in minutes) (wired)</label>
                            <input id="film_length"
                                wire:model="movie.film_length"
                                class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            @error('movie.film_length') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-start-4 col-span-3">
                            <label for="film_format" class="block text-sm font-medium leading-5 text-gray-800">Film Format (wired)</label>
                            <select id="film_format"
                                wire:model="movie.film_format"
                                class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <option>35mm</option>
                                <option>Digital</option>
                                <option>Other</option>
                            </select>
                            @error('movie.film_format') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <x-table-producer></x-table-producer>

                    <hr class="mt-10 mb-10">

                    <x-table-sales></x-table-sales>

                    <div class="flex mt-12 justify-end items-center space-x-3">
                        <span>
                                <span
                                    x-data="{ open: false }"
                                    x-init="
                                        @this.on('notify-saved', () => {
                                            setTimeout(() => { open = false }, 2500);
                                            open = true;
                                        })
                                    "
                                    x-show.transition.out.duration.1000ms="open"
                                    style="display: none;"
                                    class="text-gray-600">
                                    Saved!
                                </span>
                        </span>

                        <span class="inline-flex rounded-md shadow-sm mr-8">
                            <button type="submit"
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

    </form>

    <!-- Add/Edit Person Modal -->
    <x-modal.dialog wire:model="showingEditModal">
        <x-slot name="title">
            Add/Edit person
        </x-slot>

        <x-slot name="content">

            <form wire:submit.prevent="savePerson">
                <div>
                    <label for="first_name">First name</label>
                    <input id="first_name"
                        wire:model="personEditing.first_name"
                        >
                </div>
                <div>
                    <label for="last_name">Last name</label>
                    <input id="last_name"
                        wire:model="personEditing.last_name"
                        >
                </div>
                <div>
                    <button type="submit">Save</button>
                </div>
            </form>
    
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-modal.dialog>

    <!-- Delete Person Modal -->
    <form wire:submit.prevent="deletePerson">
        <x-modal.confirmation wire:model.defer="showingDeleteModal">
            <x-slot name="title">Delete person</x-slot>
    
            <x-slot name="content">
                <div class="py-8">Do you want to remove this person?</div>
            </x-slot>
    
            <x-slot name="footer">
                <x-button wire:click="$set('showingDeleteModal', false)">Cancel</x-button>
    
                <x-button type="submit">Delete</x-button>
            </x-slot>
        </x-modal.confirmation>
    </form>

</div>
