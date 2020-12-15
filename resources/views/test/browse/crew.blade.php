<x-layout>
    <div class="m-10">


        <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Crew listing for {{$media->title}}
            </h3>

            <ul class="divide-y divide-gray-200">
                    <li class="py-4 flex space-x-3">
                        <div class="flex flex-col">
                            @foreach($media->crew as $crew)
                                <span class="text-sm leading-5 text-gray-700"> {{$crew->title->name}}: {{$crew->person->fullname}}
                                <span class="text-sm leading-5 text-gray-600"> ({{$crew->points}} points)</span>
                                </span>
                            @endforeach
                        </div>
                    </li>



            </ul>

        </div>





    </div>


</x-layout>
