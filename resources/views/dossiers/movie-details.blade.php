<x-modal.dialog wire:model="showDetailsModal">
    <x-slot name="title">
        Movie details
    </x-slot>

    <x-slot name="content">
        @if ($movie->id)
            <div class="grid grid-cols-3 gap-4 px-16 my-8">
                <div class="col-span-2">
                    <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                        Original title
                    </label>
                    <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                        {{ $movie->original_title }}
                    </div>
                </div>

                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                        Status
                    </label>
                    <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                        {{ $movie->fiche->status->name }}
                    </div>
                </div>

                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                        Country of origin
                    </label>
                    <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                        {{ $movie->film_country_of_origin }}
                    </div>
                </div>
                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                        Copyright
                    </label>
                    <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                        {{ $movie->year_of_copyright }}
                    </div>
                </div>
                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                        Film genre
                    </label>
                    <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                        {{ $movie->genre ? $movie->genre->name : '' }}
                    </div>
                </div>

                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                        Audience
                    </label>
                    <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                        {{ $movie->audience ? $movie->audience->name : '' }}
                    </div>
                </div>
                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                        Film type
                    </label>
                    <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                        {{ $movie->film_type }}
                    </div>
                </div>

                <div class="col-span-3">
                    <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                        Synopsis
                    </label>
                    <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                        {{ $movie->synopsis }}
                    </div>
                </div>

                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                        Film director
                    </label>
                    <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                        {{ $movie->director }}
                    </div>
                </div>
            </div>
        @endif

        <x-slot name="footer">
            <x-button.primary wire:click="$set('showDetailsModal', false)">
                OK
            </x-button.primary>
        </x-slot>
    </x-slot>
</x-modal.dialog>