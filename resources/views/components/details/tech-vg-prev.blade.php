<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-photography-dev-prev">

    <div class="col-span-2 mb-4 text-lg">
        <h3>Technical information</h3>
    </div>

    <div class="col-span-1 col-end-7">
        <x-form.select
            :print="$print"
            :id="'audience'"
            :label="'Audience'"
            :hasError="$errors->has('movie.audience_id')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.audience_id')"
            wire:model="movie.audience_id"
            value="{{ $allAaudiencesById[$movie->audience_id]['name'] }}"
        >

            @foreach ($gameAudiences as $audience)
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
