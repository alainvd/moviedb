<div class="w-full p-4 mx-auto bg-white rounded-md shadow-md md:px-8 lg:px-16 sm:w-11/12">
    <form wire:submit.prevent="save">
        <!-- fake field to force form submit -->
        <input wire:model="form_updated_unique" id="form_updated_unique" type="hidden"/>
        <!-- title -->
        <div class="my-8" id="part-title">
            <x-details.title :movie="$movie"></x-details.title>
        </div>

        <!-- basic -->
        <div class="my-8" id="part-basic">
            <x-details.basic :movie="$movie" :countries="$countries" :years="$years" :genres="$genres"></x-details.basic>
        </div>

        <!-- summary -->
        <div class="my-8" id="part-summary">
            <x-details.summary :movie="$movie"></x-details.summary>
        </div>

        <!-- cast/crew -->
        <div class="my-8" id="part-castcrew-again">
            @livewire('table-edit-movie-crews', ['movie_id' => $movie->id, 'backoffice' => $backoffice])
        </div>

        <!-- photography -->
        <div class="my-8" id="photography">
            <x-details.photography :movie="$movie" :languages="$languages"></x-details.photography>
        </div>

        <!-- producers -->
        <div class="my-8" id="producers">
            <!-- <x-table-producer></x-table-producer> -->
            <!-- @livewire('table-edit-example-memory', ['media_id' => $movie->id]) -->
            @livewire('table-edit-movie-producers', ['movie_id' => $movie->id, 'backoffice' => $backoffice])
        </div>

        <!-- agents -->
        <div class="my-8" id="agents">
            <!-- <x-table-sales></x-table-sales> -->
            @livewire('table-edit-movie-sales-agents', ['movie_id' => $movie->id])
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
            </span>

            <div x-data class="flex items-center justify-end space-x-3">
                <x-button.primary type="submit">Save Changes</x-button.primary>

                <x-button.secondary @click="location.reload();">Discard</x-button.secondary>
            </div>
        </div>
    </form>
</div>