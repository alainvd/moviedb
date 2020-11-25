<x-layout>
    <div class="pt-2 pb-6 md:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        Movies List
                    </h2>
                </div>
            </div>


            <div class="flex flex-col mt-4">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Title
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Copyright
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Director
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Nationality
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Updated By
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Last Update
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Status
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Awards
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($movies as $movie)
                                @if($loop->odd)
                                    <tr class="bg-white">
                                @else
                                    <tr class="bg-gray-100">
                                        @endif
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
<<<<<<< HEAD
                                            <a href="{{route('movie_detail', ['movie'=>$movie->id])}}">{{$movie->original_title}}</a>
=======
                                            <a href="{{route('movie_detail_applicant', ['movie'=>$movie->id])}}">{{$movie->original_title}}</a>
{{--                                            {{$movie->id}}--}}
>>>>>>> Routes update
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700 text-center">
                                            {{$movie->year_of_copyright}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700 text-center">
                                            ---
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700 text-center">
                                            {{$movie->film_country_of_origin}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700 text-center">
                                            Matteo SOLARO
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700 text-center">
                                            30-06-2020
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700 text-center">
                                            Complete
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700 text-center flex justify-center">
                                            <svg width="20" height="20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.208 2.44c.25-.768 1.335-.768 1.585 0l1.265 3.894a.833.833 0 00.792.575h4.096c.807 0 1.142 1.034.49 1.509l-3.313 2.406a.833.833 0 00-.303.932l1.265 3.895c.25.768-.63 1.407-1.282.931l-3.313-2.406a.834.834 0 00-.98 0l-3.313 2.406c-.653.476-1.532-.164-1.282-.931l1.265-3.895a.833.833 0 00-.302-.932L2.564 8.418c-.653-.475-.316-1.509.49-1.509H7.15a.833.833 0 00.793-.575L9.208 2.44v0z"
                                                    stroke="#D69E2E" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
