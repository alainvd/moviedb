<div class="my-8">
    <h3 class="text-lg leading-tight font-normal">
        Description of the Project
    </h3>
    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-1">
            <x-form.input
                :id="'film-id'"
                :label="'Film ID'"
                :hasError="$errors->has('film_id')"
                name="film_id"
                placeholder="'Enter film ID'"
            ></x-form.input>

            @error('film_id')
                <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-span-1">
            <x-form.input
                :id="'film-title'"
                :label="'Film Title'"
                :disabled="true"
                name="film_title"
                placeholder="'Film Title'"
            ></x-form.input>
        </div>
        <div class="col-span-1">
            <x-form.input
                :id="'country'"
                :label="'Country'"
                :disabled="true"
                placeholder="'Country'"
            ></x-form.input>
        </div>
        <div class="col-span-1">
            <x-button.secondary class="mt-6">
                Select
            </x-button.secondary>
        </div>
    </div>
</div>
