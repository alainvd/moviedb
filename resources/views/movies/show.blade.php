<x-landing-layout>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Movie Information
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Some insights about the movie
            </p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-200">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Title
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$movie->title}}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Genre
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$movie->genre->name}}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Audience
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$movie->audience->name}}
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Distributors
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            @foreach($movie->distributors as $distributor)
                                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                    <div class="w-0 flex-1 flex items-center">


                                    <span class="ml-2 flex-1 w-0 truncate">
                  {{$distributor->name}}
                </span>
                                    </div>

                                </li>
                            @endforeach

                        </ul>
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Crew
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            @foreach($movie->crew as $crewLine)
                                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                    <div class="w-0 flex-1 flex items-center">


                                    <span class="ml-2 flex-1 w-0 truncate">
                  {{$crewLine->person->fullName}} ({{$crewLine->title->name}}) - {{$crewLine->points}} points
                </span>
                                    </div>

                                </li>
                            @endforeach

                        </ul>
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        People
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            @foreach($movie->people as $person)
                                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                    <div class="w-0 flex-1 flex items-center">


                                    <span class="ml-2 flex-1 w-0 truncate">
                  {{$person->fullName}}
                </span>
                                    </div>

                                </li>
                            @endforeach

                        </ul>
                    </dd>
                </div>
            </dl>
        </div>
    </div>

</x-landing-layout>
