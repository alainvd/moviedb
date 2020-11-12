<x-layout>

    <div class="pt-2 pb-6 md:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        Dossiers
                    </h2>
                </div>
            </div>


            <div class="flex flex-col mt-4">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <!--
Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
Read the documentation to get started: https://tailwindui.com/documentation
-->
                        <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Dossiers
                            </h3>

                            <!--
  Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
  Read the documentation to get started: https://tailwindui.com/documentation
-->
                            <ul class="divide-y divide-gray-200">
                                @foreach($dossiers as $dossier)
                                <li class="py-4 flex space-x-3">
                                    <div class="flex flex-col">
                                        <span class="text-sm leading-5 font-medium text-gray-900">PROJECT REF ID: {{$dossier->id}}-{{$dossier->project_ref_id}}</span>
                                        @foreach($dossier->media as $media)
                                        <span class="text-sm leading-5 text-gray-500">Media {{$media->id}}: {{$media->title}}</span>
                                        @endforeach
                                    </div>
                                </li>
                                @endforeach


                            </ul>

                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>




</x-layout>
