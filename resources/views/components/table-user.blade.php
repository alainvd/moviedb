<div>
    <div class="pb-5">
        <h3 class="text-xl font-medium leading-6 text-gray-900">
            {{$title}}
        </h3>
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full bg-gray-200 divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase bg-gray-50">
                                ROLE
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase bg-gray-50">
                                FIRST NAME
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase bg-gray-50">
                                LAST NAME
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase bg-gray-50">
                                GENDER
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase bg-gray-50">
                                NATIONALITY 1
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase bg-gray-50">
                                NATIONALITY 2
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase bg-gray-50">
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
                            <td class="px-6 py-4 text-sm font-medium leading-5 text-gray-900 whitespace-no-wrap">
                                {{$user->role}}
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                {{$user->first_name}}
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                {{$user->last_name}}
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                {{$user->gender}}
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                {{$user->nationality1}}
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                {{$user->nationality2}}
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                {{$user->country_of_residence}}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <span class="inline-flex justify-end rounded-md print:hidden">
              <button type="button"
                      class="px-3 py-2 mt-3 text-xs font-medium leading-4 text-gray-900 transition duration-150 ease-in-out border border-gray-700 rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800">
                Add
              </button>
        </span>
    </div>
</div>
