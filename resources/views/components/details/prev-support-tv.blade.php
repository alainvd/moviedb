<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-prev-support-tv">
<div class="col-span-2 mb-4 text-lg">
        Previous Support
    </div>

    <div class="col-span-1 col-start-1">
        <x-form.select
            :id="'dev_support_flag'"
            :label="'Project Supported by MEDIA Development'"
            :type="'text'"
            :hasError="$errors->has('movie.dev_support_flag')"
            wire:model="movie.dev_support_flag"
            >
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </x-form.input>

    </div>
    <div class="col-span-1" x-data="{ show: false }" x-show="$wire.movie.dev_support_flag == 'Yes'">
        <x-form.input
            :id="'dev_support_reference'"
            :label="'Previous Project Reference'"
            :type="'text'"
            wire:model="movie.dev_support_reference"
            >

        </x-form.input>

    </div>

</div>
