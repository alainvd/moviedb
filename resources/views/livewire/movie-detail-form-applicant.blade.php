<div>
    <form wire:submit.prevent="save">

        <div>Applicant form</div>

        <!-- title -->
        <div class="border-2 my-2">
        <div>Title component</div>
        <x-details.title :movie="$movie"></x-details.title>
        </div>

        <!-- form -->
        <div class="flex flex-col mt-4 px-0 sm:px-4">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 bg-white p-4 sm:p-10">

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
                    @livewire('person-table', ['movie_id' => $movie->id, 'backoffice' => $backoffice])
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

                    <hr class="mt-10 mb-10">

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
                                    " x-show.transition.out.duration.1000ms="open" style="display: none;"
                                class="text-gray-600">
                                Saved!
                            </span>
                        </span>

                        <div x-data class="flex justify-end items-center space-x-3">
                            <x-button.primary type="submit">Save Changes</x-button.primary>

                            <x-button.secondary @click="location.reload();">Discard</x-button.secondary>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>