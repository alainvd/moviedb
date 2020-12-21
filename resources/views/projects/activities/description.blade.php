<h3 class="text-lg leading-tight font-normal my-4">
    Description of the Project
</h3>
<div class="grid grid-cols-4 gap-4">
    <div class="col-span-1">
        <x-form.input
            :id="'film-id'"
            :label="'Film ID'"
            placeholder="'Enter film ID'"
        ></x-form.input>
    </div>
    <div class="col-span-1">
        <x-form.input
            :id="'film-title'"
            :label="'Film Title'"
            :disabled="true"
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
