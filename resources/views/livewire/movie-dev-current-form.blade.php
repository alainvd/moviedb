<x-fiche-form
    :layout="$layout"
    :print="$print"
    :fiche="$fiche"
    :hasHistory="$hasHistory ?? false"
    :dossier="$dossier ?? null"
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

    <!-- basic-dev-current -->
    <div class="mt-8 mb-4">
        <x-details.basic-dev-current
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
            :userExperiences="$userExperiences"
        ></x-details.basic-dev-current>
    </div>

    <!-- summary -->
    <div class="mb-8">
        <x-details.summary
            :print="$print"
            :rules="$rules"
            :movie="$movie"
        ></x-details.summary>
    </div>

    <!-- tech-dev-current -->
    <div class="my-8">
        <x-details.tech-dev-current
            :print="$print"
            :rules="$rules"
            :movie="$movie"
            :filmFormats="$filmFormats"
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"
            :languagesGroupedChoices="$languagesGroupedChoices"
            :languagesSelected="$shootingLanguages"
        ></x-details.tech-dev-current>
    </div>

    <!-- cast/crew -->
    <div class="my-8" id="table-crews">
        <div id="table-crews-wrapper" class="@if ($errors->has('crewErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-crews-dev-current', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
        </div>

        <div id="table-crews-messages">
        @foreach ($errors->get('crewErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>

    <!-- location -->
    <div class="my-8" id="table-location">
        <div id="table-location-wrapper" class="@if ($errors->has('locationErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
            @livewire('table-edit-movie-locations-dev-current', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
        </div>

        <div id="table-location-messages">
            @foreach ($errors->get('locationErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
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

    <!-- producers-dev-current -->
    <div class="my-8" id="table-producers">
        <div id="table-producers-wrapper" class="@if ($errors->has('producerErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-producers-dev-current', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
        </div>

        <div id="table-producers-messages">
        @foreach ($errors->get('producerErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>

    <!-- budget-dev-current -->
    <div class="my-8">
        <x-details.budget-dev-current
            :print="$print"
            :rules="$rules"
            :movie="$movie"
            :currencies="$currencies"
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"
        ></x-details.budget-dev-current>
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
