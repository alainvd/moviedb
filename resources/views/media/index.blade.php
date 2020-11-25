<x-layout>


    <!-- This example requires Tailwind CSS v2.0+ -->

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:p-8 ">
        <!-- Content goes here -->

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <ul class="divide-y divide-gray-200">
                    @foreach($medium as $media)
                        <li class="py-4 flex">
                            {{--                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">--}}
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{$media->title}}</p>
                                <p class="text-sm font-medium text-gray-900">Audience: {{$media->audience->name}}</p>
                                <p class="text-sm font-medium text-gray-900">Genre: {{$media->genre->name}}</p>
                                <p class="text-sm text-gray-500">{{$media->grantable_type}}</p>

                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>


        </div>
    </div>


</x-layout>
