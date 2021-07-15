<x-fiche-form
    :layout="$layout"
    :print="$print"
    :movie="$movie"
    :fiche="$fiche"
    :hasHistory="$hasHistory ?? false"
    :dossier="$dossier"
    :activity="$activity ?? null"
    :isApplicant="$isApplicant"
    :isEditor="$isEditor"
    :standAloneFiche="$standAloneFiche"
    :tab="'fiche'"
>

    @if($isApplicant)
    <!-- title -->
    <div class="my-8">
        <x-details.title
            :movie="$movie"
            :fiche="$fiche"
        ></x-details.title>
    </div>
    @endif

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
            
            :gameGenresChoices="$gameGenresChoices"
            :gameGenresSelected="$gameGenres"
            :allGenresById="$allGenresById"
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

    <!-- tech-tv -->
    <div class="my-8">
        <x-details.tech-vg-prev
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
   

    <!-- cast/crew -->
    <div class="my-8" id="table-crews">
        @livewire('table-edit-movie-crews', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
    </div>

   <!-- producers-dev-previous -->
   <div class="my-8" id="table-producers">
        <div id="table-producers-wrapper" class="@if ($errors->has('producerErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-producers-dev-previous', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
        </div>

        <div id="table-producers-messages">
        @foreach ($errors->get('producerErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>

    <!-- sales distributors -->
    <div class="my-8" id="table-sales-distributors">
        <div id="table-sales-distributors-wrapper" class="@if ($errors->has('salesDistributorErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-sales-distributors', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
        </div>

        <div id="table-sales-distributors-messages">
        @foreach ($errors->get('salesDistributorErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
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
