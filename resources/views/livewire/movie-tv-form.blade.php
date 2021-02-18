<form wire:submit.prevent="submit">
    <div>
        <div class="w-full p-4 mx-auto bg-white rounded-md shadow-md md:px-8 lg:px-16 sm:w-11/12">
            <!-- title -->
            <div class="my-8">
                <h1>Audiovisual Work - Production - TV and Online</h1>
                <!--<x-details.title :movie="$movie" :fiche="$fiche"></x-details.title>-->
            </div>

            <!-- basic -->
            <div class="my-8">
                <x-details.basic-tv
                    :movie="$movie"
                    :isApplicant="$isApplicant"
                    :audiences="$audiences"
                    :countries="$countries"
                    :filmTypes="$filmTypes"
                    :genres="$genres"
                    :statuses="$statuses"
                    :years="$years"></x-details.basic>
            </div>

            <!-- summary -->
            <div class="my-8">
                <x-details.summary :movie="$movie"></x-details.summary>
            </div>

           

            <!-- cast/crew -->
            <div class="my-8" id="table-crews">
                @livewire('table-edit-movie-crews', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
            </div>

             <!-- technical info -->
             <div class="my-8">
                <x-details.tech-tv
                    :movie="$movie"
                    :filmFormats="$filmFormats"
                    :languages="$languages"
                    :languagesSelected="$shootingLanguages"></x-details.tech-tv>
            </div>
          

            <!-- producers-tv -->
            <div class="my-8" id="table-producers">
                @livewire('table-edit-movie-producers-dev-current', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
            </div>

            <!-- budget-tv -->
            <div class="my-8">
                <x-details.budget-dev-current></x-details.budget>
            </div>

            <!-- comments -->
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
