<x-fiche-form
    :layout="$layout"
    :print="$print"
    :fiche="$fiche"
    :hasHistory="$hasHistory ?? false"
    :dossier="$dossier"
    :activity="$activity ?? null"
    :isApplicant="$isApplicant"
    :isEditor="$isEditor"
    :standAloneFiche="$standAloneFiche"
>

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
            :allAudiencesById="$allAudiencesById"
            :countries="$countries"
            :countriesGrouped="$countriesGrouped"
            :countriesByCode="$countriesByCode"
            :filmTypes="$filmTypes"
            :gameGenres="$gameGenres"
            :gameGenresChoices="$gamePlatformsChoices"
            :gameGenresSelected="$gamePlatforms"
            :allGenresById="$allGenresById"
            :platforms="$platforms"
            :statuses="$statuses"
            :statusesById="$statusesById"
            :years="$years"
            :userExperiences="$userExperiences"
        ></x-details.basic-vg-prev>
    </div>

  

    <!-- summary -->
    <div class="my-8">
        <x-details.summary
            :print="$print"
            :rules="$rules"
            :movie="$movie"
        ></x-details.summary>
    </div>

    <!-- tech-vg -->
    <div class="my-8">
        <x-details.tech-vg
            :print="$print"
            :rules="$rules"
            :movie="$movie"
            :filmFormats="$filmFormats"
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"
            :languagesGroupedChoices="$languagesGroupedChoices"
            :languagesSelected="$shootingLanguages"
            :gameOptionsChoices="$gameOptionsChoices"
            :gameOptionsSelected="$gameOptions"
            :gameModesChoices="$gameModesChoices"
            :gameModesSelected="$gameModes"
            :gamePlatformsChoices="$gamePlatformsChoices"
            :gamePlatformsSelected="$gamePlatforms"
        ></x-details.tech-vg>
    </div>
   
    <!-- Ownership -->
    <div class="my-8">
        <x-details.ownership
            :print="$print"
            :rules="$rules"
            :workOrigins="$workOrigins"
            :workContractTypes="$workContractTypes"
            :movie="$movie"
        ></x-details.ownership>
    </div>

    <!-- cast/crew -->
    <div class="my-8" id="table-crews">
        @livewire('table-edit-movie-crews', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
    </div>

    <!-- producers-dev-previous -->
    <div class="my-8" id="table-producers">
        @livewire('table-edit-movie-producers', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
    </div>

    <!-- agents-dev-previous -->
    <div class="my-8" id="table-agents">
        @livewire('table-edit-movie-sales-agents', ['movie_id' => $movie->id, 'print' => $print])
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
