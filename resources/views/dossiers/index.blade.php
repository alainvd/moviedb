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
            <div class="text-lg text-gray-600 pr-8">
                In order to link films, TV movies, series, video games or shorts in an application for funding of a specific Creative Europe call for proposals, the detailed information on the works needs to be inserted in the Creative Europe MEDIA database.
                <br><br>
                Step 1: select a call for proposals and enter the draft application ID received while starting the application process in the Submission service.
                <br><br>
                Step 2: choose the type of work that needs to be linked to the application.
                <br><br>
                Step 3: search or create and select the work.
                <br><br>
                Step 4: download the technical dossier, go back to the application Submission service and attach the document in the annexes of the application form.
            </div>
            <img class="h-auto w-auto mx-auto lg:h-64 lg:mt-16" src="{{ asset("images/undraw_videographer.png") }}" alt="Videographer">
        </div>

        @livewire('dossiers.my-dossiers')

    </div>
</x-dynamic-component>
