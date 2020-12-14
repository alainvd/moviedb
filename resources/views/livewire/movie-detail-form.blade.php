<form wire:submit.prevent="submit">
    <div class="md:py-6">
        <div class="p-4 md:px-8 lg:px-16 mx-auto w-full sm:w-11/12 rounded-md shadow-md bg-white">
        <!-- @todo display "Viewing as: Applicant / ECEA -->
        <!-- <div class="text-xs leading-tight">Applicant form</div> -->
            <!-- fake field to force form submit -->
            <!-- <input wire:model="form_updated_unique" id="form_updated_unique" type="hidden" /> -->
            <!-- title -->
            <div class="my-8">
                <x-details.title :movie="$movie" :fiche="$fiche"></x-details.title>
            </div>

            <!-- basic -->
            <div class="my-8">
                <x-details.basic
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
                <x-details.summary :movie="$movie"></x-details.summary>
            </div>

            <!-- cast/crew -->
            <div class="my-8" id="table-crews">
                @livewire('table-edit-movie-crews', ['movie_id' => $movie->id, 'backoffice' => $backoffice])
            </div>

            <!-- photography -->
            <div class="my-8">
                <x-details.photography
                    :movie="$movie"
                    :filmFormats="$filmFormats"
                    :languages="$languages"></x-details.photography>
            </div>

            <!-- producers -->
            <div class="my-8" id="table-producers">
                @livewire('table-edit-movie-producers', ['movie_id' => $movie->id, $backoffice => false])
            </div>

            <!-- Total budget -->
            <div class="my-8">
                <x-details.budget
                    :currencies="$currencies"
                    ></x-details.budget>
            </div>

            <!-- agents -->
            <div class="my-8" id="table-agents">
                @livewire('table-edit-movie-sales-agents', ['movie_id' => $movie->id])
            </div>

            <!-- buttons -->
            <div class="flex mt-12 justify-end items-center space-x-3">
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

                <div x-data class="flex justify-end items-center space-x-3">
                    <x-button.primary type="submit">Save</x-button.primary>

                    <!-- <x-button.secondary @click="location.reload();">Discard</x-button.secondary> -->
                </div>
            </div>
        </div>
    </div>
</form>
