<div class="flex-1 print:hidden">
    <div class="border-b border-gray-200">
        <nav class="flex -mb-px space-x-8" aria-label="Tabs">
            <a href="{{$routeDetails}}"
                @if($tab == 'fiche')
                class="flex px-1 py-4 text-base font-medium text-indigo-600 border-b-2 border-indigo-500 whitespace-nowrap"
                @else
                class="flex px-1 py-4 text-base font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-200 whitespace-nowrap"
                @endif
                aria-current="page">
                Fiche details
            </a>

            <a href="{{$routeDossiers}}"
                @if($tab == 'dossiers')
                class="flex px-1 py-4 text-base font-medium text-indigo-600 border-b-2 border-indigo-500 whitespace-nowrap"
                @else
                class="flex px-1 py-4 text-base font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-200 whitespace-nowrap"
                @endif
                aria-current="page">
                Dossiers
                @if($fiche->dossiers->count())
                <span
                    @if($tab == 'dossiers')
                    class="hidden px-3 py-1 ml-3 text-xs font-medium text-indigo-600 bg-indigo-100 rounded-full md:inline-block"
                    @else
                    class="hidden px-3 py-1 ml-3 text-xs font-medium text-gray-900 bg-gray-100 rounded-full md:inline-block"
                    @endif
                    >{{$fiche->dossiers->count()}}</span>
                @endif
            </a>

            <a href="#"
                @if($tab == 'prizes')
                class="flex px-1 py-4 text-base font-medium text-indigo-600 border-b-2 border-indigo-500 whitespace-nowrap"
                @else
                class="flex px-1 py-4 text-base font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-200 whitespace-nowrap"
                @endif
                >
                Award / Prizes
                <span
                    @if($tab == 'prizes')
                    class="hidden px-3 py-1 ml-3 text-xs font-medium text-indigo-600 bg-indigo-100 rounded-full md:inline-block"
                    @else
                    class="hidden px-3 py-1 ml-3 text-xs font-medium text-gray-900 bg-gray-100 rounded-full md:inline-block"
                    @endif
                    >6</span>
            </a>

            <!--
            <a href="#"
                @if($tab == 'links')
                class="flex px-1 py-4 text-base font-medium text-indigo-600 border-b-2 border-indigo-500 whitespace-nowrap"
                @else
                class="flex px-1 py-4 text-base font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-200 whitespace-nowrap"
                @endif
                >
                Links
                <span
                    @if($tab == 'links')
                    class="hidden px-3 py-1 ml-3 text-xs font-medium text-indigo-600 bg-indigo-100 rounded-full md:inline-block"
                    @else
                    class="hidden px-3 py-1 ml-3 text-xs font-medium text-gray-900 bg-gray-100 rounded-full md:inline-block"
                    @endif
                    >6</span>
            </a>
            -->
        </nav>
    </div>
</div>
