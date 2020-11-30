<div class="p-4 md:px-8 lg:px-16 mx-auto w-full sm:w-11/12 rounded-md shadow-md bg-white">
    <div class="text-xs leading-tight">Backoffice form</div>
    <form wire:submit.prevent="save">
        <!-- fake field to force form submit -->
        <input wire:model="form_updated_unique" id="form_updated_unique" type="hidden"/>
        <!-- title -->
        <div class="border-2 my-2">
        <div>Title component</div>    
        <x-details.title :movie="$movie"></x-details.title>
        </div>

        <!-- basic -->
        <div class="border-2 my-2">
        <div>Basic component</div>    
        <x-details.basic :movie="$movie" :countries="$countries" :years="$years" :genres="$genres"></x-details.basic>
        </div>

        <!-- summary -->
        <div class="border-2 my-2">
        <div>Summary component</div>    
        <x-details.summary :movie="$movie"></x-details.summary>
        </div>

        <!-- cast/crew -->
        <div class="border-2 my-2">
        <div>Cast/crew component</div>    
        @livewire('person-table', ['movie_id' => $movie->id, 'backoffice' => $this->backoffice])
        </div>

        <!-- photography -->
        <div class="border-2 my-2">
        <div>Photography component</div>    
        <x-details.photography :movie="$movie" :languages="$languages"></x-details.photography>
        </div>

        <!-- producers -->
        <div class="border-2 my-2">
        <div>Producers component</div>    
        <x-table-producer></x-table-producer>
        </div>

        <!-- agents -->
        <div class="border-2 my-2">
        <div>Agants component</div>    
        <x-table-sales></x-table-sales>
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