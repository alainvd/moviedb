<x-landing-layout>
    <div class="m-10">


        <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Audiences
            </h3>

            <!--
Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
Read the documentation to get started: https://tailwindui.com/documentation
-->
            <ul class="divide-y divide-gray-200">

                    <li class="py-4 flex space-x-3">
                        <div class="flex flex-col">
                            @foreach($audience as $item)
                                <span class="text-sm leading-5 text-gray-500"> {{$item->name}}</span>
                            @endforeach
                        </div>
                    </li>



            </ul>

        </div>





    </div>


</x-landing-layout>
