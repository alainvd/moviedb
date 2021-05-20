<x-fiche-form :layout="$layout" :print="$print" :fiche="$fiche" :hasHistory="$hasHistory ?? false" :dossier="$dossier">

    <!-- title -->
    <div class="my-8">
        <x-details.title
            :movie="$movie"
            :fiche="$fiche"
        ></x-details.title>
    </div>

    <!-- basic -->
    <div class="my-8">
        <x-details.basic
            :print="$print"
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"
            :rules="$rules"
            :movie="$movie"
            :fiche="$fiche"
            :movieAudiences="$movieAudiences"
            :allAaudiencesById="$allAaudiencesById"
            :countries="$countries"
            :countriesGrouped="$countriesGrouped"
            :countriesByCode="$countriesByCode"
            :filmTypes="$filmTypes"
            :movieGenres="$movieGenres"
            :allGenresById="$allGenresById"
            :platforms="$platforms"
            :statuses="$statusesDev"
            :statusesById="$statusesByIdDev"
            :years="$years"
        ></x-details.basic>
    </div>

    <!-- summary -->
    <div class="my-8">
        <x-details.summary
            :print="$print"
            :rules="$rules"
            :movie="$movie"
        ></x-details.summary>
    </div>

    <!-- link applicant work-->
    <div class="my-8">
        <x-details.link-applicant-work
            :print="$print"
            :rules="$rules"
            :movie="$movie"
            :linkApplicantWork="$linkApplicantWork"
        ></x-details.link-applicant-work>
    </div>

    <!-- tech -->
    <div class="my-8">
        <x-details.tech
            :print="$print"
            :rules="$rules"
            :movie="$movie"
            :filmFormats="$filmFormats"
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"
            :languagesGroupedChoices="$languagesGroupedChoices"
            :languagesSelected="$shootingLanguages"
        ></x-details.tech>
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

    <!-- comments -->
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
