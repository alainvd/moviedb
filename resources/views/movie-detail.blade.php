<x-layout>
    <div class="pt-2 pb-6 md:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            {{--            <div class="md:flex md:items-center md:justify-between">--}}
            <div class="flex-1 min-w-0 flex flex-row justify-between">
                <div><h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        MDB2020/0423 - Movie details
                    </h2>
                </div>
                <div class="text-gray-600 inline-block align-baseline mt-3">Modified on 7 January 2020 by John Smith
                </div>
            </div>
        </div>


        <div class="flex flex-col mt-4 px-4">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 bg-white p-10">


                    <div class="grid grid-cols-8 gap-6">
                        <div class="col-start-1 col-span-6">
                            <label for="original_title" class="block text-sm font-medium leading-5 text-gray-800">Original
                                Title</label>
                            <input id="original_title"
                                   class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        </div>

                        <div class="col-start-7 col-end-9">
                            <label for="status" class="block text-sm font-medium leading-5 text-gray-700">Status</label>
                            <select id="status"
                                    class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <option>Incomplete</option>
                                <option>Complete</option>
                            </select>
                        </div>


                        <div class="col-start-1 col-span-2">
                            <label for="nationality" class="block text-sm font-medium leading-5 text-gray-700">Nationality</label>
                            <select id="nationality"
                                    class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <option>Belgian</option>
                                <option>French</option>
                            </select>
                        </div>

                        <div class="col-start-4 col-span-2">
                            <label for="copyright"
                                   class="block text-sm font-medium leading-5 text-gray-700">Copyright</label>
                            <select id="copyright"
                                    class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <option>2006</option>
                                <option>2007</option>
                                <option>2008</option>
                                <option>2009</option>
                                <option>2010</option>
                                <option>2011</option>
                            </select>
                        </div>

                        <div class="col-start-7 col-span-2">
                            <label for="film_genre" class="block text-sm font-medium leading-5 text-gray-700">Film
                                Genre</label>
                            <select id="film_genre"
                                    class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <option>Fiction</option>
                                <option>Drama</option>
                            </select>
                        </div>


                        <div class="col-start-1 col-span-2">
                            <label for="delivery_platform" class="block text-sm font-medium leading-5 text-gray-700">Film
                                Delivery Platform</label>
                            <select id="delivery_platform"
                                    class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <option>Features / Cinema</option>
                                <option>...</option>
                            </select>
                        </div>

                        <div class="col-start-4 col-span-2">
                            <label for="audience"
                                   class="block text-sm font-medium leading-5 text-gray-700">Audience</label>
                            <select id="audience"
                                    class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <option>All</option>
                                <option>13+</option>
                                <option>16+</option>
                                <option>18+</option>
                            </select>
                        </div>

                        <div class="col-start-7 col-span-2">
                            <label for="film_type" class="block text-sm font-medium leading-5 text-gray-700">Film
                                Type</label>
                            <select id="film_type"
                                    class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <option>One-off</option>
                                <option>Recurring</option>
                            </select>
                        </div>

                    </div>

                    <div class="grid grid-cols-9 gap-6 mt-16">
                        <div class="col-start-1 col-span-4">
                            <label for="ID" class="block text-sm font-medium leading-5 text-gray-800">ID</label>
                            <input id="ID"
                                   class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">

                        </div>
                        <div class="col-start-5 col-span-2 mt-6">
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

                    <hr class="mt-10 mb-10">

                    <x-table-producer></x-table-producer>

                    <hr class="mt-10 mb-10">

                    <x-table-sales></x-table-sales>

                    <div class="flex mt-12 justify-end">

 <span class="inline-flex rounded-md shadow-sm mr-8">
  <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
Save Changes
  </button>
</span>

                        <span class="inline-flex rounded-md shadow-sm">
  <button type="button" class="inline-flex items-center px-3 py-2 border border-gray-600 text-sm leading-4 font-medium rounded-md text-gray-700
  bg-white hover:bg-indigo-50 focus:outline-none focus:border-gray-600 focus:shadow-outline-indigo active:bg-indigo-200 transition ease-in-out duration-150">
  Discard
</button>
</span>
                    </div>


                </div>
            </div>
        </div>

    </div>
    </div>
</x-layout>
