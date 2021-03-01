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

    <!-- photography -->
    <div class="my-8">
        <x-details.photography-dev-current
            :rules="$rules"
            :movie="$movie"
            :filmFormats="$filmFormats"
            :languages="$languages"
            :languagesSelected="$shootingLanguages"></x-details.photography>
    </div>

    <!-- cast/crew -->
    <div class="my-8" id="table-crews">
        @livewire('table-edit-movie-crews-dev-current', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
    </div>

    <!-- Ownership -->
    <div class="my-8">
        <x-details.ownership
            :rules="$rules"
            :workOrigins="$workOrigins"
            :workContractTypes="$workContractTypes"
            :movie="$movie"></x-details.photography>
    </div>

    <!-- producers-dev-current -->
    <div class="my-8" id="table-producers">
        @livewire('table-edit-movie-producers-dev-current', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
    </div>

    <!-- budget-dev-current -->
    <div class="my-8">
        <x-details.budget-dev-current
            :rules="$rules"></x-details.budget>
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