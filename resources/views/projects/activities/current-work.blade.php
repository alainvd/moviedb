 <!-- Previous works table -->
 <h3 class="text-lg leading-tight font-normal my-4">
     Audiovisual Work - Development - For grant request
 </h3>
 <x-table>
     <x-slot name="head">
         <x-table.heading>TITLE</x-table.heading>
         <x-table.heading>GENRE</x-table.heading>
         <x-table.heading>PRODUCTION YEAR</x-table.heading>
         <x-table.heading>FILM ID</x-table.heading>
         <x-table.heading>&nbsp;</x-table.heading>
     </x-slot>

     <x-slot name="body">

        @if ($dossier->fiches()->forActivity($activity->id)->count())

            @include('projects.activities.work-fiche-rows', [
                'fiches' => $dossier->fiches()->forActivity($activity->id)->get(),
                'dossier' => $dossier,
                'activity' => $activity,
            ])

        @else

        <x-table.row>
            <x-table.cell class="text-center" colspan="5">No movies yet</x-table.cell>
        </x-table.row>

        @endif

     </x-slot>
 </x-table>
 <div class="mt-5 text-right">
     <x-anchors.secondary :url="url(sprintf('dossiers/%s/activities/%s/fiches/dist',$dossier->id, $activity->id))">
         Add
     </x-anchors.secondary>
 </div>
