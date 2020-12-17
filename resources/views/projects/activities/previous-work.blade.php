<h3 class="text-lg leading-tight font-normal my-4">
    Audiovisual Work - Development - Recent work / previous experience
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

    </x-slot>
</x-table>
<div class="mt-5 text-right">
    <x-anchors.secondary :url="url(sprintf('dossiers/%s/fiches/dist',$dossier->id))">
        Add
    </x-anchors.secondary>
</div>
