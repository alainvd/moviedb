<form wire:submit.prevent="submit">
    <div>
        <!-- TODO: should be based on layout, not role -->
        @if ($isApplicant)
        <div class="w-full p-4 mx-auto my-4 bg-white rounded-md shadow-md md:px-8 lg:px-16">
        @elseif ($isEditor)
        <div class="w-full p-4 mx-auto my-4 bg-white rounded-md shadow-md">
        @endif

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

            <!-- agents-dev-previous -->
            <div class="my-8" id="table-agents">
                @livewire('table-edit-movie-sales-agents-dev-previous', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
            </div>

            <!-- comments -->
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

            <!-- buttons -->
            <div class="flex items-center justify-end mt-12 space-x-3">
                <div x-data class="flex items-center justify-end space-x-3">
                    <x-button.primary wire:click="callValidate()">Validate</x-button.primary>
                    <x-button.primary type="submit">Save</x-button.primary>
                    <!-- <x-button.secondary wire:click="reject()">Reject</x-button.secondary> -->
                </div>
            </div>
        </div>
    </div>
</form>
