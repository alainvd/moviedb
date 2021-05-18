<x-ecl-layout>
    <div class="m-10">

        <div class="px-4 py-5 bg-white border-b border-gray-200 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
                Crew listing for {{$movie->title}}
            </h3>

            <ul class="divide-y divide-gray-200">
                <li class="flex py-4 space-x-3">
                    <div class="flex flex-col">
                        @foreach($movie->crew as $crew)
                            <span class="text-sm leading-5 text-gray-700"> {{$crew->title->name}}: {{$crew->person->fullname}}
                            <span class="text-sm leading-5 text-gray-600"> ({{$crew->points}} points)</span>
                            </span>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>

    </div>
</x-ecl-layout>