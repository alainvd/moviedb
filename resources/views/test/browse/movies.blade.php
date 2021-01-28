<x-landing-layout>
    <div class="m-10">

        <!-- This example requires Tailwind CSS v2.0+ -->
        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($medium as $media)
                <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
                    <div class="w-full flex items-center justify-between p-6 space-x-6">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <h3 class="text-gray-900 text-sm font-medium">{{$media->title}}</h3>
                            </div>
                            @if($media->genre)
                                <p class="mt-1 text-gray-500 text-sm truncate">Genre: {{$media->genre->name}}</p>
                            @endif
                            @if($media->audience)
                                <p class="mt-1 text-gray-500 text-sm truncate">Audience: {{$media->audience->name}}</p>
                            @endif
                            @foreach($media->crew as $crew)
                                @if($crew->person)
                                    <div class="text-sm leading-5 text-gray-700"> {{$crew->title->name}}
                                        : {{$crew->person->fullname}}
{{--                                        @if($crew->points)--}}
                                            <span
                                                class="text-sm leading-5 text-gray-600"> ({{$crew->points}} points)</span>
{{--                                        @endif--}}
                                    </div>
                                @endif
                            @endforeach

                        </div>

                        @if($media->grantable_type == "App\VideoGame")
                            <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"
                                 src="https://images.unsplash.com/photo-1580234831315-438a4813685c?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                                 alt="">
                        @endif
                        @if($media->grantable_type == "App\Movie")
                            <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"
                                 src="https://images.unsplash.com/photo-1542204165-65bf26472b9b?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                                 alt="">


                        @endif
                    </div>

                </li>
            @endforeach


        </ul>
        <br/>

        {{ $medium->links() }}
    </div>




</x-landing-layout>



