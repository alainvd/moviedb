<x-fiche-form :layout="$layout">

    <!-- title -->
    <div class="my-8">
        <x-details.title
            :movie="$movie"
            :fiche="$fiche">
        </x-details.title>
    </div>

    <!-- basic -->
    <div class="my-8">
        <x-details.basic-tv
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"
            :rules="$rules"
            :movie="$movie"
            :isApplicant="$isApplicant"
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
        @livewire('table-edit-movie-crews', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
    </div>

        <!-- technical info -->
        <div class="my-8">
        <x-details.tech-tv
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"
            :rules="$rules"
            :movie="$movie"
            :filmFormats="$filmFormats"
            :languages="$languages"
            :languagesSelected="$shootingLanguages"></x-details.tech-tv>
    </div>
    
    <!-- producers-tv -->
    <div class="my-8" id="table-producers">
        @livewire('table-edit-movie-producers-dev-current', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
    </div>

    <!-- budget-tv -->
    <div class="my-8">
        <x-details.budget-dev-current
            :isApplicant="$isApplicant"
            :isEditor="$isEditor"
            :rules="$rules"
            :currencies="$currencies"
            ></x-details.budget>
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