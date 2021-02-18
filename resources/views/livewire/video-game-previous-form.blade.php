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
                <x-details.basic-vg-prev
                    :movie="$movie"
                    :isApplicant="$isApplicant"
                    :countries="$countries"
                    :genres="$genres"
                    :platforms="$platforms"
                    :statuses="$statuses"
                    :years="$years"></x-details.basic>
            </div>

            <!-- audience-->
            <div class="my-8">
                <x-details.tech-vg-prev
                    :movie="$movie"
                    :audiences="$audiences"></x-details.tech-vg-prev>
            </div>

            <!-- external references (ISAN, EIDR, links,...) -->
            <div class="my-8">
                <x-details.external-references :movie="$movie"></x-details.external-references>
            </div>

            <!-- summary -->
            <div class="my-8">
                <x-details.synopsis :movie="$movie"></x-details.synopsis>
            </div>

            <!-- technical info -->
            <div class="my-8">
                <x-details.tech-vg :movie="$movie"></x-details.tech-vg>
            </div>


            <!-- cast/crew -->
            <div class="my-8" id="table-crews">
                @livewire('table-edit-movie-crews-dev-current', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
            </div>

            <!-- producers-dev-previous -->
            <div class="my-8" id="table-producers">
                @livewire('table-edit-movie-producers-dev-previous', ['movie_id' => $movie->id, 'isApplicant' => $isApplicant, 'isEditor' => $isEditor])
            </div>

            <!-- agents-dev-previous -->
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
                <div x-data class="flex items-center justify-end space-x-3">
                    <x-button.primary wire:click="callValidate()">Validate</x-button.primary>
                    <x-button.primary type="submit">Save</x-button.primary>
                    <x-button.secondary wire:click="reject()">Reject</x-button.secondary>
                </div>
            </div>
        </div>
    </div>
</form>
