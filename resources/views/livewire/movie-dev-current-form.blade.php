<x-fiche-form :layout="$layout">

    <!-- title -->
    <div class="my-8">
        <x-details.title
            :movie="$movie"
            :fiche="$fiche"></x-details.title>
    </div>

    <!-- basic -->
    <div class="my-8">
        <x-details.basic-dev-current
            :rules="$rules"
            :movie="$movie"
            :isApplicant="$isApplicant"
            :audiences="$audiences"
            :countries="$countries"
            :filmTypes="$filmTypes"
            :genres="$genres"
            :platforms="$platforms"
            :userExperiences="$userExperiences"
            :statuses="$statuses"
            :years="$years"></x-details.basic>
    </div>

    <!-- summary -->
    <div class="my-8">
        <x-details.summary
            :rules="$rules"
            :movie="$movie"></x-details.summary>
    </div>

    <!-- tech -->
    <div class="my-8">
        <x-details.tech-dev-current
            :rules="$rules"
            :movie="$movie"
            :filmFormats="$filmFormats"
            :languages="$languages"
            :languagesSelected="$shootingLanguages"></x-details.tech-dev-current>
    </div>

    <!-- cast/crew -->
    <div class="my-8" id="table-crews">
        <div id="table-crews-wrapper" class="@if ($errors->has('crewErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-crews-dev-current', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
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

    <!-- Ownership -->
    <div class="my-8">
        <x-details.ownership
            :rules="$rules"
            :workOrigins="$workOrigins"
            :workContractTypes="$workContractTypes"
            :movie="$movie"></x-details.ownership>
    </div>

    <!-- producers-dev-current -->
    <div class="my-8" id="table-producers">
        <div id="table-producers-wrapper" class="@if ($errors->has('producerErrorMessages')) px-3 py-2 mt-1 transition duration-150 ease-in-out border border-red-500 rounded-md shadow-md @endif">
        @livewire('table-edit-movie-producers-dev-current', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
        </div>

        <div id="table-producers-messages">
        @foreach ($errors->get('producerErrorMessages') as $message)<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@endforeach
        </div>
    </div>

    <!-- budget-dev-current -->
    <div class="my-8">
        <x-details.budget-dev-current
            :rules="$rules"></x-details.budget-dev-current>
    </div>

    <!-- comments -->
    @if($isEditor)
    <div class="my-8">
        <x-form.textarea
            :id="'comments'"
            :label="'EACEA Comments'"
            :hasError="$errors->has('fiche.comments')"
            :isRequired="FormHelpers::isRequired($rules, 'fiche.comments')"
            wire:model="fiche.comments">
        </x-form.textarea>

        @error('fiche.comments')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    @endif

</x-fiche-form>
