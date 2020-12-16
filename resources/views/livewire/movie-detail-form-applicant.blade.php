
<div class="p-4 md:px-8 lg:px-16 mx-auto w-full sm:w-11/12 rounded-md shadow-md bg-white">
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
            @livewire('table-edit-movie-crews', ['movie_id' => $movie->id])
        </div>

        <!-- photography -->
        <div class="my-8" id="photography">
            <x-details.photography :movie="$movie" :languages="$languages"></x-details.photography>
        </div>

        <!-- producers -->
        <div class="my-8" id="producers">
            <!-- <x-table-producer></x-table-producer> -->
            <!-- @livewire('table-edit-example-memory', ['media_id' => $movie->id]) -->
            @livewire('table-edit-movie-producers', ['movie_id' => $movie->id, $backoffice => false])
        </div>

        <!-- agents -->
        <div class="my-8" id="agents">
            <!-- <x-table-sales></x-table-sales> -->
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
            </span>

            <div x-data class="flex justify-end items-center space-x-3">
                <x-button.primary type="submit">Save Changes</x-button.primary>

                <x-button.secondary @click="location.reload();">Discard</x-button.secondary>
            </div>
        </div>
    </form>
</div>
