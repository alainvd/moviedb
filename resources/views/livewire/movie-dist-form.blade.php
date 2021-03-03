<x-fiche-form :layout="$layout">

    <!-- title -->
    <div class="my-8">
        <x-details.title
            :movie="$movie"
            :fiche="$fiche"></x-details.title>
    </div>

    <!-- basic -->
    <div class="my-8">
        <x-details.basic
            :rules="$rules"
            :movie="$movie"
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"
            :audiences="$audiences"
            :countries="$countries"
            :filmTypes="$filmTypes"
            :genres="$genres"
            :platforms="$platforms"
            :statuses="$statuses"
            :years="$years"></x-details.basic>
    </div>

    <!-- summary -->
    <div class="my-8">
        <x-details.summary
            :rules="$rules"
            :movie="$movie"></x-details.summary>
    </div>

    <!-- cast/crew -->
    <div class="my-8" id="table-crews">
        <div id="table-crews-wrapper" class="@if ($errors->has('crewErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-crews', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
        </div>

        <div id="table-crews-messages">
        @foreach ($errors->get('crewErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>

    <!-- location -->
    <div class="my-8" id="table-location">
        <div id="table-location-wrapper" class="@if ($errors->has('locationErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-locations', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
        </div>

        <div id="table-location-messages">
        @foreach ($errors->get('locationErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>
    
    @if ($isEditor)
    <div class="mt-5 text-right" x-data="{points: @entangle('totalPoints')}">
        <span class="mr-4">
            TOTAL SCORE: <span class="font-bold" x-text="points"></span>
        </span>
    </div>
    @endif

    <!-- points -->
    @if($isEditor)
    <div class="my-8">
        <x-details.points
            :rules="$rules"
            :movie="$movie"
            :countries="$countries"></x-details.summary>
    </div>
    @endif

    <!-- photography -->
    <div class="my-8">
        <x-details.photography
            :rules="$rules"
            :movie="$movie"
            :filmFormats="$filmFormats"
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"
            :languages="$languages"
            :languagesSelected="$shootingLanguages"></x-details.photography>
    </div>

    <!-- producers -->
    <div class="my-8" id="table-producers">
        <div id="table-producers-wrapper" class="@if ($errors->has('producerErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-producers', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
        </div>

        <div id="table-producers-messages">
        @foreach ($errors->get('producerErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>
    
    <!-- Total budget -->
    <div class="my-8">
        <x-details.budget
            :rules="$rules"
            :currencies="$currencies"
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"></x-details.budget>
    </div>

    <!-- agents -->
    <div class="my-8" id="table-agents">
        <div id="table-agents-wrapper" class="@if ($errors->has('salesAgentErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-sales-agents', ['movie_id' => $movie->id])
        </div>

        <div id="table-agents-messages">
        @foreach ($errors->get('salesAgentErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>

    <!-- documents -->
    <div class="my-8" id="table-documents">
        <div id="table-documents-wrapper" class="@if ($errors->has('filesErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-documents', ['movie_id' => $movie->id, 'documentTypes' => $documentTypes])
        </div>

        <div id="table-documents-messages">
        @foreach ($errors->get('filesErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>
    
    <!-- comments -->
    @if($isEditor)
    <div class="my-8">
        <x-form.textarea
            :id="'comments'"
            :label="'EACEA Comments'"
            :hasError="$errors->has('fiche.comments')"
            :isRequired="FormHelpers::isRequired($rules, 'fiche.comments')"
            wire:model="fiche.comments"></x-form.textarea>

        @error('fiche.comments')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    @endif

</x-fiche-form>