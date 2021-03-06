<x-fiche-form
    :layout="$layout"
    :print="$print"
    :fiche="$fiche"
    :hasHistory="$hasHistory ?? false"
    :dossier="$dossier ?? null"
    :activity="$activity ?? null"
    :isApplicant="$isApplicant"
    :isEditor="$isEditor"
    :standAloneFiche="$standAloneFiche ?? null"
>

    <!-- title -->
    <div class="my-8">
        <x-details.title
            :movie="$movie"
            :fiche="$fiche"
        ></x-details.title>
    </div>

    <!-- basic -->
    <div class="mt-8 mb-4">
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
            :statuses="$statusesDist"
            :statusesById="$statusesByIdDist"
            :years="$years"
        ></x-details.basic>
    </div>

    <!-- summary -->
    <div class="mb-8">
        <x-details.summary
            :print="$print"
            :rules="$rules"
            :movie="$movie"
        ></x-details.summary>
    </div>

    <!-- cast/crew -->
    <div class="my-8" id="table-crews">
        <div id="table-crews-wrapper" class="@if ($errors->has('crewErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-crews', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
        </div>

        <div id="table-crews-messages">
        @foreach ($errors->get('crewErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>

    <!-- location -->
    <div class="my-8" id="table-location">
        <div id="table-location-wrapper" class="@if ($errors->has('locationErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-locations', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
        </div>

        <div id="table-location-messages">
        @foreach ($errors->get('locationErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>

    @if ($isEditor)
    <div class="mt-5 text-right" x-data="{points: @entangle('totalPoints')}">
        <span class="mr-4">
            TOTAL SCORE: <span class="font-bold" x-text="points.toFixed(2)"></span>
        </span>
    </div>
    @endif

    <!-- points -->
    @if($isEditor)
    <div class="my-8">
        <x-details.points
            :print="$print"
            :rules="$rules"
            :movie="$movie"
            :countries="$countries"
            :countriesGrouped="$countriesGrouped"
            :countriesByCode="$countriesByCode"
        ></x-details.summary>
    </div>
    @endif

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

    <!-- producers -->
    <div class="my-8" id="table-producers">
        <div id="table-producers-wrapper" class="@if ($errors->has('producerErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-producers', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor, 'print' => $print])
        </div>

        <div id="table-producers-messages">
        @foreach ($errors->get('producerErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>

    <!-- Total budget -->
    <div class="my-8">
        <x-details.budget
            :print="$print"
            :rules="$rules"
            :movie="$movie"
            :currencies="$currencies"
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"
        ></x-details.budget>
    </div>

    <!-- agents -->
    <div class="my-8" id="table-agents">
        <div id="table-agents-wrapper" class="@if ($errors->has('salesAgentErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-sales-agents', ['movie_id' => $movie->id, 'print' => $print])
        </div>

        <div id="table-agents-messages">
        @foreach ($errors->get('salesAgentErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>

    <!-- documents -->
    <div class="my-8" id="table-documents">
        <div id="table-documents-wrapper" class="@if ($errors->has('filesErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-documents', ['movie_id' => $movie->id, 'documentTypes' => $documentTypes, 'print' => $print])
        </div>

        <div id="table-documents-messages">
        @foreach ($errors->get('filesErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
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
