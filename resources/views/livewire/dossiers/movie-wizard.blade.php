<div class="pb-8 my-8 bg-white shadow-md" x-data="{
        currentStep: @entangle('currentStep')
    }">
    <!-- <h1 class="my-4 text-3xl font-light leading-tight">
        Films on the move
    </h1> -->

    <!-- tabs -->
    <div class="flex flex-row flex-wrap w-full">
        <div class="w-1/3 py-4 px-8 bg-gray-300 text-center text-lg transition duration-500 ease-in-out {{ $currentStep === 1 ? 'bg-blue-700 text-white' : 'text-gray-900' }}">
            1. Define your criteria
        </div>
        <div class="w-1/3 py-4 px-8 bg-gray-300 text-center text-lg transition duration-500 ease-in-out {{ $currentStep === 2 ? 'bg-blue-700 text-white' : 'text-gray-900' }}">
            2. Select your work
        </div>
        <div class="w-1/3 py-4 px-8 bg-gray-300 text-center text-lg transition duration-500 ease-in-out {{ $currentStep === 3 ? 'bg-blue-700 text-white' : 'text-gray-900' }}">
            3. Finalize your selection
        </div>
    </div>

    <!-- content -->
    <div class="p-16" style="min-height: 450px">
        <!-- Search form -->
        <div class="transition duration-500 ease-in-out" x-hide x-show="currentStep === 1">
            <div class="w-full mx-auto md:w-1/2">
                <h3 class="my-4 text-xl font-bold text-left">
                    Step 1: In order to retrieve work information, please complete at least 1 search criteria as defined below:
                </h3>

                <x-form.input
                    :id="'original-title'"
                    :label="'Original Film Title'"
                    :hasError="$errors->has('originalTitle')"
                    wire:model="originalTitle">
                </x-form.input>

                @error('originalTitle')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror

                <div class="my-8"></div>

                <x-form.input
                    :id="'film-director'"
                    :label="'Film Director'"
                    :hasError="$errors->has('director')"
                    wire:model="director">
                </x-form.input>

                @error('director')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="transition duration-500 ease-in-out" class="" x-hide x-show="currentStep === 2">
            <h3 class="w-full mx-auto my-4 text-xl font-bold text-left md:w-1/2">
                Step 2: Select the work in the list.
                <br>
                If you cannot find it, you can try different search criteria:
            </h3>

            <x-table class="mt-8 mb-2">
                <x-slot name="head">
                    <x-table.heading>SELECT</x-table.heading>
                    <x-table.heading>TITLE</x-table.heading>
                    <x-table.heading>DIRECTOR</x-table.heading>
                    <x-table.heading>COUNTRY</x-table.heading>
                    <x-table.heading>STATUS</x-table.heading>
                    <x-table.heading>COPYRIGHT</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($results as $result)
                        <x-table.row>
                            <x-table.cell class="text-center">
                                <input type="radio" name="selected_movie"
                                    wire:click="selectMovie({{ $result->id }})">
                            </x-table.cell>
                            <x-table.cell class="text-center">
                                {{ $result->original_title  }}
                            </x-table.cell>
                            <x-table.cell class="text-center">
                                {{ $result->director }}
                            </x-table.cell>
                            <x-table.cell class="text-center">
                                {{ $result->film_country_of_origin  }}
                            </x-table.cell>
                            <x-table.cell class="text-center">
                                {{ $result->fiche->status->name  }}
                            </x-table.cell>
                            <x-table.cell class="text-center">
                                {{ $result->year_of_copyright  }}
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell class="text-center" colspan="6">No movies found</x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            @if ($results->count())
                {{ $results->links('components.pagination.movie-wizard') }}
            @endif
        </div>

        <div class="transition duration-500 ease-in-out" x-hide x-show="currentStep === 3">
            <h3 class="w-full mx-auto my-4 text-xl font-bold text-left md:w-1/2">
                Step 3: Confirm your selection or go back to search again.
            </h3>

            @if ($movie->id)

            <div class="grid grid-cols-3 gap-4 px-16 my-8 md:ml-8">
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
                        {{ !empty($movie->genre) ? $movie->genre->name : '' }}
                    </div>
                </div>

                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                        Film delivery platform
                    </label>
                    <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                        {{ !empty($movie->delivery_platform) ? $platforms[$movie->delivery_platform] : '' }}
                    </div>
                </div>
                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-light leading-5 text-gray-700" for="original-title">
                        Audience
                    </label>
                    <div class="pb-2 border-b-2 border-indigo-600" id="original-title">
                        {{ !empty($movie->audience) ? $movie->audience->name : '' }}
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
        </div>
    </div>
    <div class="flex flex-row justify-between px-16 mt-16" style="line-height: 38px">
        <x-button.secondary wire:click="previousStep" :disabled="$currentStep === 1">
            Previous
        </x-button.secondary>

        @if ($currentStep > 1)
            <div class="text-gray-500 text-md">
                Could not find the work you are looking for?
                &nbsp;
                @if($admissionsTable && $admission)
                <a href="{{ route('dossier-create-fiche', [
                    'dossier' => $dossier,
                    'activity' => $activity,
                    'admissionsTable' => $admissionsTable,
                    'admission' => $admission
                ]) }}" class="text-indigo-600">
                @else
                <a href="{{ route('dossier-create-fiche', [
                    'dossier' => $dossier,
                    'activity' => $activity,
                ]) }}" class="text-indigo-600">
                @endif
                    Create a new work
                </a>
            </div>
        @endif

        <x-button.primary wire:click="nextStep" x-text="currentStep === 3 ? 'Yes, I confirm' : 'Next'">
        </x-button.primary>
    </div>
</div>

<img class="mt-4" src="{{ asset('images/dossier/wizard-1.png')}}" alt="Movie wizard">
