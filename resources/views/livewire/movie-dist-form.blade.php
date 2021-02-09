<form wire:submit.prevent="submit">
    <div>
        <div class="w-full p-4 mx-auto bg-white rounded-md shadow-md md:px-8 lg:px-16">
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
                @livewire('table-edit-movie-crews', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
            </div>

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
                @livewire('table-edit-movie-producers', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
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
                @livewire('table-edit-movie-sales-agents', ['movie_id' => $movie->id])
            </div>

            <!-- documents -->
            <div class="my-8" id="table-documents">
                @livewire('table-edit-movie-documents', ['movie_id' => $movie->id, 'documentTypes' => $documentTypes])
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

            <!-- buttons -->
            <div class="flex items-center justify-end mt-12 space-x-3">
                <span>
                    <span x-data="{ open: false }" x-init="
                            @this.on('notify-saved', () => {
                                setTimeout(() => { open = false }, 2500);
                                open = true;
                            })
                        " x-show.transition.out.duration.1000ms="open" style="display: none;" class="text-gray-600">
                        Saved!
                    </span>
                    <span x-data="{ open: false }" x-init="
                            @this.on('validation-errors', () => {
                                setTimeout(() => { open = false }, 2500);
                                open = true;
                            })
                        " x-show.transition.out.duration.1000ms="open" style="display: none;" class="text-red-600">
                        Validation errors!
                    </span>
                </span>

                <div x-data class="flex items-center justify-end space-x-3">
                    <x-button.primary wire:click="callValidate()">Validate</x-button.primary>
                    <x-button.primary type="submit">Save</x-button.primary>
                    <x-button.secondary wire:click="reject()">Reject</x-button.secondary>
                </div>
            </div>
        </div>
    </div>
</form>
