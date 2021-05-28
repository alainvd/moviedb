<x-dynamic-component
    :component="$layout"
    :title="'Quick start guide'"
    :crumbs="$crumbs"
    :class="'dossier-page'">
    <div class="px-4 bg-white">
        @if (session()->has('success'))
            <x-alerts.success>
                {{ session()->get('success')}}
            </x-alerts.success>
        @endif

        <div class="w-full mt-4 mb-16 lg:flex">
            <div class="pr-8 space-y-4 text-lg text-gray-600">
                <p>
                    In order to link films, TV movies, series, video games or shorts in an application for funding of a specific Creative Europe call for proposals, the detailed information on the works needs to be inserted in the Creative Europe MEDIA database.
                </p>
                <p>
                    This platform is not the entry point to submit an application for funding within the Creative Europe programme. To find open call for proposals and start the application process, please consult the <a class="text-indigo-600 hover:text-indigo-900" href="https://ec.europa.eu/info/funding-tenders/opportunities/portal/screen/home" target="_blank">Funding & Tender opportunities portal.</a>
                </p>
                <p>
                    On this page, you will find the dossiers linking ongoing applications and information on audiovisual works.
                </p>
                <p>
                    If the dossier list is empty, the reasons can be the following:
                    <ul class="list-disc list-inside">
                        <li>No dossier was created during the preparation of an application for funding via the eGrant submission service</li>
                        <li>The EU login used for creating the application in the eGrant submission service is different than the one used to enter in the Creative Europe MEDIA database is different</li>
                        <li>The call is closed</li>
                    </ul>
                </p>
            </div>
            <img class="w-auto h-auto mx-auto lg:h-64 lg:mt-16" src="{{ asset("images/undraw_videographer.png") }}" alt="Videographer">
        </div>

        @livewire('dossiers.my-dossiers')

    </div>
</x-dynamic-component>
