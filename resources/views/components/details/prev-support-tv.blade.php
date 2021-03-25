<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-prev-support-tv">

    <div class="col-span-2 mb-4 text-lg md:col-span-3">
        <h3>Previous Support</h3>
    </div>

    <div class="col-span-1 col-start-1">
        <x-form.select
            :id="'dev_support_flag'"
            :print="$print"
            :label="'Project Supported by MEDIA Development'"
            :hasError="$errors->has('movie.dev_support_flag')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.dev_support_flag')"
            wire:model="movie.dev_support_flag"
            value="{{ $movie->dev_support_flag == 1 ? 'Yes' : 'No' }}"
        >
            <option value="1">Yes</option>
            <option value="0">No</option>
        </x-form.select>

        @error('movie.dev_support_flag')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1" x-data="{ show: false }" x-show="$wire.movie.dev_support_flag == 1">
        <x-form.input
            :print="$print"
            :id="'dev_support_reference'"
            :label="'Previous Project Reference'"
            :hasError="$errors->has('movie.dev_support_reference')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.dev_support_reference')"
            wire:model="movie.dev_support_reference"
            value="{{ $movie->dev_support_reference }}"
        ></x-form.input>

        @error('movie.dev_support_reference')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

</div>
