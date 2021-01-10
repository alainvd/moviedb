<form wire:submit.prevent="submit">
    <div class="md:py-6">
        <div class="w-full p-4 mx-auto bg-white rounded-md shadow-md md:px-8 lg:px-16 sm:w-11/12">
        <!-- @todo display "Viewing as: Applicant / ECEA -->
        <!-- <div class="text-xs leading-tight">Applicant form</div> -->
            <!-- title -->
            <div class="my-8">
                <x-details.title :movie="$movie" :fiche="$fiche"></x-details.title>
            </div>

            <!-- basic -->
            <div class="my-8">
                <x-details.basic-dev-prev
                    :movie="$movie"
                    :isApplicant="$isApplicant"
                    :countries="$countries"
                    :filmTypes="$filmTypes"
                    :genres="$genres"
                    :platforms="$platforms"
                    :statuses="$statuses"
                    :years="$years"></x-details.basic>
            </div>

            <!-- summary -->
            <div class="my-8">
                <x-details.summary :movie="$movie"></x-details.summary>
            </div>

            <!-- cast/crew -->
            <!--
            <div class="my-8" id="table-crews">
                @livewire('table-edit-movie-crews', ['movie_id' => $movie->id, 'backoffice' => $backoffice])
            </div>
            -->

            <!-- points -->
            <!--
            <div class="my-8">
                <x-details.points
                    :movie="$movie"
                    :countries="$countries"></x-details.summary>
            </div>
            -->

            <!-- photography -->
            <div class="my-8">
                <x-details.photography-dev-prev
                    :movie="$movie"
                    :filmFormats="$filmFormats"
                    :languages="$languages"
                    :audiences="$audiences"></x-details.photography>
            </div>

            <!-- link applicant work-->
            <div class="my-8">
                <x-details.link-applicant-work
                    :movie="$movie"
                    :linkApplicantWork="$linkApplicantWork"></x-details>
            </div>

            <!-- producers -->
            <div class="my-8" id="table-producers">
                @livewire('table-edit-movie-producers-dev-previous', ['movie_id' => $movie->id, $backoffice => false])
            </div>

            <!-- Total budget -->
            <!--
            <div class="my-8">
                <x-details.budget
                    :currencies="$currencies"
                    ></x-details.budget>
            </div>
            -->

            <!-- agents -->
            <div class="my-8" id="table-agents">
                @livewire('table-edit-movie-sales-agents-dev-previous', ['movie_id' => $movie->id])
            </div>

            <div class="my-8">
                <x-form.textarea
                    :id="'comments'"
                    :label="'EACEA Comments'"
                    :hasError="$errors->has('fiche.comments')"
                    wire:model="fiche.comments">
                </x-form.textarea>

                @error('fiche.comments')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

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
