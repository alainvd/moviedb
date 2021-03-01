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

    <!-- link applicant work-->
    <div class="my-8">
        <x-details.link-applicant-work
            :rules="$rules"
            :movie="$movie"
            :linkApplicantWork="$linkApplicantWork"></x-details>
    </div>

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

    <!-- producers-dev-previous -->
    <div class="my-8" id="table-producers">
        @livewire('table-edit-movie-producers-dev-previous', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
    </div>

    <!-- distributors -->
    <div class="my-8" id="table-agents">
        @livewire('table-edit-movie-sales-distributors', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
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