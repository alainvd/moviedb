<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-photography-dev-prev">

    

    <div class="col-span-1 col-end-7">
        <x-form.select
            :id="'audience'"
            :label="'Audience'"
            :hasError="$errors->has('media.audience_id')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.audience_id')"
            wire:model="media.audience_id">

            @foreach ($audiences as $audience)
                <option value="{{ $audience['id'] }}">
                    {{ $audience['name'] }}
                </option>
            @endforeach

        </x-form.select>

        @error('media.audience_id')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

</div>
