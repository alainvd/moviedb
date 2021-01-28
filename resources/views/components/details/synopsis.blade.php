<div class="grid grid-cols-3 gap-4 fiche-details-component" id="fdc-summary">
  
    <div class="col-span-4 lg:col-span-3">
        <x-form.textarea
            :id="'synopsis'"
            :label="'Synopsis'"
            :hasError="$errors->has('movie.synopsis')"
            wire:model="movie.synopsis">
        </x-form.textarea>

        @error('movie.synopsis')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
</div>
