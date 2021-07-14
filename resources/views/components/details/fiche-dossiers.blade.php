<x-layout :title="$title">

    <div class="w-full p-4 mx-auto my-4 bg-white rounded-md shadow-md">

        <!-- title -->
        <div class="my-8">
            <x-details.title
                :movie="$movie"
                :fiche="$fiche"
            ></x-details.title>
        </div>

        @include('components.details.fiche-tabs')

        <div class="mt-8 mb-4">
            <div class="col-span-2 mb-4 text-lg">
                <h3>Dossiers</h3>
            </div>
            <x-table>
                <x-slot name="head">
                    <x-table.heading>ID</x-table.heading>
                    <x-table.heading>ACTION</x-table.heading>
                    <x-table.heading>YEAR</x-table.heading>
                    <x-table.heading>COMPANY</x-table.heading>
                    <x-table.heading>COUNTRY</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach($dossiers as $dossier)
                    <x-table.row>
                        <x-table.cell class="tracking-tight text-center font-md">
                            <a class="text-indigo-700"
                             href="{{route('dossiers.show', $dossier)}}">{{$dossier->project_ref_id}}</a>
                        </x-table.cell>
                        <x-table.cell class="tracking-tight text-center font-md">
                            {{$dossier->action->name}}
                        </x-table.cell>
                        <x-table.cell class="tracking-tight text-center font-md">
                            {{$dossier->year}}
                        </x-table.cell>
                        <x-table.cell class="tracking-tight text-center font-md">
                            {{$dossier->company}}
                        </x-table.cell>
                        <x-table.cell class="tracking-tight text-center font-md">
                            {{$dossier->country}}
                        </x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
        </div>

    </div>

</x-layout>