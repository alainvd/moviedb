<x-ecl-layout>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
                Movie Information
            </h3>
            <p class="max-w-2xl mt-1 text-sm text-gray-500">
                Some insights about the movie
            </p>
        </div>
        <div class="px-4 py-5 border-t border-gray-200 sm:p-0">
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
                        {{$movie->genre->name ?? 'No Genre Found'}}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Audience
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$movie->audience->name ?? 'No Audience Found'}}
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Distributors
                    </dt>

                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if(!$movie->distributors->isEmpty())
                            <ul class="border border-gray-200 divide-y divide-gray-200 rounded-md">
                                @foreach($movie->distributors as $distributor)
                                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                        <div class="flex items-center flex-1 w-0">
                                            <span class="flex-1 w-0 ml-2 truncate">
                                                {{$distributor->name}}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            No Distributor Found
                        @endif
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Document
                    </dt>

                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if(!$movie->documents->isEmpty())
                            <ul class="border border-gray-200 divide-y divide-gray-200 rounded-md">
                                @foreach($movie->documents as $document)
                                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                        <div class="flex items-center flex-1 w-0">
                                            <span class="flex-1 w-0 ml-2 truncate">
                                                {{$document->filename}}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            No Documents Found
                        @endif
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Languages
                    </dt>

                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if(!$movie->languages->isEmpty())
                            <ul class="border border-gray-200 divide-y divide-gray-200 rounded-md">
                                @foreach($movie->languages as $language)
                                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                        <div class="flex items-center flex-1 w-0">
                                            <span class="flex-1 w-0 ml-2 truncate">
                                                {{$language->name}}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            No Languages Found
                        @endif
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Crew
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul class="border border-gray-200 divide-y divide-gray-200 rounded-md">
                            @foreach($movie->crew as $crewLine)
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex items-center flex-1 w-0">
                                        <span class="flex-1 w-0 ml-2 truncate">
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
                        <ul class="border border-gray-200 divide-y divide-gray-200 rounded-md">
                            @foreach($movie->people as $person)
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex items-center flex-1 w-0">
                                        <span class="flex-1 w-0 ml-2 truncate">
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
</x-ecl-layout>