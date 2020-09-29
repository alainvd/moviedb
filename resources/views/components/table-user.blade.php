<div>
    <div class="pb-5">
        <h3 class="text-xl leading-6 font-medium text-gray-900">
            {{$title}}
        </h3>
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 bg-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                ROLE
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                FULL NAME
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                GENDER
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                NATIONALITY 1
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                NATIONALITY 2
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                                RESIDENCE
                            </th>
                            <th class="px-6 py-3 bg-gray-50"></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <!-- Odd row -->
                            @if($loop->odd)
                                <tr class="bg-white">
                            @else
                                <tr class="bg-gray-100">
                                    @endif

                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                        {{$user->role}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$user->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$user->gender}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$user->nationality1}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$user->nationality2}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$user->country_of_residence}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                                @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <span class="inline-flex rounded-md justify-end">
              <button type="button"
                      class="mt-3 py-2 px-3 border border-gray-700 rounded-md text-xs leading-4 font-medium text-gray-900 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                Add
              </button>
</span>
    </div>
</div>
