<div class="my-8">
    <input type="hidden" name="current_works" value="{{ $dossier->fiches()->forActivity($activity->id)->count() }}">
    <h3 class="my-4 text-lg font-normal leading-tight">
        Audiovisual Work - Development - For grant request
    </h3>
    <x-table class="{{ $errors->has('current_works') ? 'border border-red-500' : '' }}">
        <x-slot name="head">
            <x-table.heading>TITLE</x-table.heading>
            <x-table.heading>GENRE</x-table.heading>
            <x-table.heading>PRODUCTION YEAR</x-table.heading>
            <x-table.heading>FILM ID</x-table.heading>
            <x-table.heading>&nbsp;</x-table.heading>
        </x-slot>

        <x-slot name="body">

            @if ($dossier->fiches()->forActivity($activity->id)->count())

                <x-dossiers.work-fiche-rows
                    :fiches="$dossier->fiches()->forActivity($activity->id)->get()"
                    :dossier="$dossier"
                    :activity="$activity"></x-dossiers.work-fiche-rows>

            @else

            <x-table.row>
                <x-table.cell class="text-center" colspan="5">No movies yet</x-table.cell>
            </x-table.row>

            @endif

        </x-slot>
    </x-table>

    @error('current_works')
    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
    @enderror

    <div class="mt-5 text-right">
        <x-anchors.secondary :url="url(sprintf('dossiers/%s/activities/%d/fiches',$dossier->project_ref_id, $activity->id))">
            Add
        </x-anchors.secondary>
    </div>
</div>
