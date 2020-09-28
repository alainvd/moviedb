<x-layout>
    <div class="pt-2 pb-6 md:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
{{--            <div class="md:flex md:items-center md:justify-between">--}}
                <div class="flex-1 min-w-0 flex flex-row justify-between">
                    <div><h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        MDB2020/0423 - Movie details
                    </h2>
                    </div>
                    <div class="text-gray-600 inline-block align-baseline mt-3">Modified on 7 January 2020 by John Smith</div>
                </div>
            </div>


            <div class="flex flex-col mt-4 px-4">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 bg-white p-10">


                        <div class="grid grid-cols-8 gap-6">
                            <div class="col-start-1 col-span-6">
                                <label for="original_title" class="block text-sm font-medium leading-5 text-gray-800">Original Title</label>
                                <input id="original_title" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            </div>

                            <div class="col-start-7 col-end-9">
                                <label for="status" class="block text-sm font-medium leading-5 text-gray-700">Status</label>
                                <select id="status" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option>Incomplete</option>
                                    <option>Complete</option>
                                </select>
                            </div>



                            <div class="col-start-1 col-span-2">
                                <label for="nationality" class="block text-sm font-medium leading-5 text-gray-700">Nationality</label>
                                <select id="nationality" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option>Belgian</option>
                                    <option>French</option>
                                </select>
                            </div>

                            <div class="col-start-4 col-span-2">
                                <label for="copyright" class="block text-sm font-medium leading-5 text-gray-700">Copyright</label>
                                <select id="copyright" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option>2006</option>
                                    <option>2007</option>
                                    <option>2008</option>
                                    <option>2009</option>
                                    <option>2010</option>
                                    <option>2011</option>
                                </select>
                            </div>

                            <div class="col-start-7 col-span-2">
                                <label for="film_genre" class="block text-sm font-medium leading-5 text-gray-700">Film Genre</label>
                                <select id="film_genre" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option>Fiction</option>
                                    <option>Drama</option>
                                </select>
                            </div>


                            <div class="col-start-1 col-span-2">
                                <label for="delivery_platform" class="block text-sm font-medium leading-5 text-gray-700">Film Delivery Platform</label>
                                <select id="delivery_platform" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option>Features / Cinema</option>
                                    <option>...</option>
                                </select>
                            </div>

                            <div class="col-start-4 col-span-2">
                                <label for="audience" class="block text-sm font-medium leading-5 text-gray-700">Audience</label>
                                <select id="audience" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option>All</option>
                                    <option>13+</option>
                                    <option>16+</option>
                                    <option>18+</option>
                                </select>
                            </div>

                            <div class="col-start-7 col-span-2">
                                <label for="film_type" class="block text-sm font-medium leading-5 text-gray-700">Film Type</label>
                                <select id="film_type" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option>One-off</option>
                                    <option>Recurring</option>
                                </select>
                            </div>

                        </div>

                        <div class="grid grid-cols-9 gap-6 mt-16">
                            <div class="col-start-1 col-span-4">
                                <label for="ID" class="block text-sm font-medium leading-5 text-gray-800">ID</label>
                                <input id="ID" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">

                            </div>
                            <div class="col-start-5 col-span-2 mt-6">
                                                            <span class="ml-5 rounded-md shadow-sm">
              <button type="button" class="mt-1 py-2 px-3 border border-gray-700 rounded-md text-xs leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                Manage codes
              </button>
            </span>
                            </div>

                            <div class="col-start-1 col-span-9">
                                <label for="synopsis" class="block text-sm font-medium leading-5 text-gray-800">Synopsis</label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <textarea id="about" rows="6" class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"></textarea>
                                </div>

                            </div>


                        </div>

                        <hr class="mt-10">
{{--                        <table class="min-w-full">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">--}}
{{--                                    Title--}}
{{--                                </th>--}}
{{--                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">--}}
{{--                                    Copyright--}}
{{--                                </th>--}}
{{--                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">--}}
{{--                                    Director--}}
{{--                                </th>--}}
{{--                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">--}}
{{--                                    Nationality--}}
{{--                                </th>--}}
{{--                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">--}}
{{--                                    Updated By--}}
{{--                                </th>--}}
{{--                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">--}}
{{--                                    Last Update--}}
{{--                                </th>--}}
{{--                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">--}}
{{--                                    Status--}}
{{--                                </th>--}}
{{--                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">--}}
{{--                                    Awards--}}
{{--                                </th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            <tr class="bg-white">--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">--}}
{{--                                    The lives of Others--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    2006--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    Florian Henckel von Donnersmarck--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    Italy--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    Matteo SOLARO--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    30-06-2020--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    Complete--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center flex justify-center">--}}
{{--                                    <svg width="20" height="20" fill="none"--}}
{{--                                         xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <path--}}
{{--                                            d="M9.208 2.44c.25-.768 1.335-.768 1.585 0l1.265 3.894a.833.833 0 00.792.575h4.096c.807 0 1.142 1.034.49 1.509l-3.313 2.406a.833.833 0 00-.303.932l1.265 3.895c.25.768-.63 1.407-1.282.931l-3.313-2.406a.834.834 0 00-.98 0l-3.313 2.406c-.653.476-1.532-.164-1.282-.931l1.265-3.895a.833.833 0 00-.302-.932L2.564 8.418c-.653-.475-.316-1.509.49-1.509H7.15a.833.833 0 00.793-.575L9.208 2.44v0z"--}}
{{--                                            stroke="#D69E2E" stroke-width="2" stroke-linecap="round"--}}
{{--                                            stroke-linejoin="round"/>--}}
{{--                                    </svg>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr class="bg-gray-50">--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">--}}
{{--                                    A Prophet--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    2009--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    Jacques Audiard--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    France--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    Vioaine SOMJA--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    30-06-2020--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    Incomplete--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}

{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr class="bg-white">--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">--}}
{{--                                    The lives of Others--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    2006--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    Florian Henckel von Donnersmarck--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    Italy--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    ---}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    30-06-2020--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">--}}
{{--                                    New--}}
{{--                                </td>--}}

{{--                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center flex justify-center">--}}
{{--                                    <svg width="20" height="20" fill="none"--}}
{{--                                         xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <path--}}
{{--                                            d="M9.208 2.44c.25-.768 1.335-.768 1.585 0l1.265 3.894a.833.833 0 00.792.575h4.096c.807 0 1.142 1.034.49 1.509l-3.313 2.406a.833.833 0 00-.303.932l1.265 3.895c.25.768-.63 1.407-1.282.931l-3.313-2.406a.834.834 0 00-.98 0l-3.313 2.406c-.653.476-1.532-.164-1.282-.931l1.265-3.895a.833.833 0 00-.302-.932L2.564 8.418c-.653-.475-.316-1.509.49-1.509H7.15a.833.833 0 00.793-.575L9.208 2.44v0z"--}}
{{--                                            stroke="#D69E2E" stroke-width="2" stroke-linecap="round"--}}
{{--                                            stroke-linejoin="round"/>--}}
{{--                                    </svg>--}}
{{--                                    <svg width="20" height="20" fill="none"--}}
{{--                                         xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <path--}}
{{--                                            d="M9.208 2.44c.25-.768 1.335-.768 1.585 0l1.265 3.894a.833.833 0 00.792.575h4.096c.807 0 1.142 1.034.49 1.509l-3.313 2.406a.833.833 0 00-.303.932l1.265 3.895c.25.768-.63 1.407-1.282.931l-3.313-2.406a.834.834 0 00-.98 0l-3.313 2.406c-.653.476-1.532-.164-1.282-.931l1.265-3.895a.833.833 0 00-.302-.932L2.564 8.418c-.653-.475-.316-1.509.49-1.509H7.15a.833.833 0 00.793-.575L9.208 2.44v0z"--}}
{{--                                            stroke="#D69E2E" stroke-width="2" stroke-linecap="round"--}}
{{--                                            stroke-linejoin="round"/>--}}
{{--                                    </svg>--}}
{{--                                </td>--}}

{{--                            </tr>--}}

{{--                            </tbody>--}}
{{--                        </table>--}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
