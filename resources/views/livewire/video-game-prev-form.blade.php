<x-fiche-form :layout="$layout" :print="$print">

    <!-- title -->
    <div class="my-8">
        <x-details.title
            :movie="$movie"
            :fiche="$fiche"
        ></x-details.title>
    </div>

    <!-- basic-vg-prev -->
    <div class="my-8">
        <x-details.basic-vg-prev
            :print="$print"
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"
            :rules="$rules"
            :movie="$movie"
            :fiche="$fiche"
            :gameAudiences="$gameAudiences"
            :allAaudiencesById="$allAaudiencesById"
            :countries="$countries"
            :countriesByCode="$countriesByCode"
            :filmTypes="$filmTypes"
            :gameGenres="$gameGenres"
            :allGenresById="$allGenresById"
            :platforms="$platforms"
            :statuses="$statuses"
            :statusesById="$statusesById"
            :years="$years"
            :userExperiences="$userExperiences"
        ></x-details.basic-vg-prev>
    </div>

    <!-- tech-vg-prev-->
    <div class="my-8">
        <x-details.tech-vg-prev
            :movie="$movie"
            :gameAudiences="$gameAudiences"
            :allAaudiencesById="$allAaudiencesById"
        ></x-details.tech-vg-prev>
    </div>

    <!-- summary -->
    <div class="my-8">
        <x-details.summary
            :print="$print"
            :rules="$rules"
            :movie="$movie"
        ></x-details.summary>
    </div>
    
    <!--  tech-vg -->
    <div class="my-8">
        <x-details.tech-vg
            :movie="$movie"
        ></x-details.tech-vg>
    </div>

    <!-- cast/crew -->
    <div class="my-8" id="table-crews">
        @livewire('table-edit-movie-crews-dev-current', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
    </div>

    <!-- producers-dev-previous -->
    <div class="my-8" id="table-producers">
        @livewire('table-edit-movie-producers-dev-previous', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
    </div>

    <!-- agents-dev-previous -->
    <div class="my-8" id="table-agents">
        @livewire('table-edit-movie-sales-agents-dev-previous', ['movie_id' => $movie->id, 'print' => $print])
    </div>

    @if($isEditor)
    <div class="my-8">
        <x-form.textarea
            :print="$print"
            :id="'comments'"
            :label="'EACEA Comments'"
            :hasError="$errors->has('fiche.comments')"
            :isRequired="FormHelpers::isRequired($rules, 'fiche.comments')"
            wire:model="fiche.comments"
            value="{{ $fiche->comments }}"
        ></x-form.textarea>

        @error('fiche.comments')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    @endif

</x-fiche-form>