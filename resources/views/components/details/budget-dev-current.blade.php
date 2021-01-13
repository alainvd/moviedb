<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-budget-dev-current">

    <div class="col-span-1">
        <x-form.input-trailing
            :id="'total_budget_euro'"
            :label="'Total Estimated Production Budget including Development'"
            :trailing="'€'"
            :hasError="$errors->has('movie.total_budget_euro')"
            wire:model="movie.total_budget_euro"
            placeholder="0">

        </x-form.input>

        @error('movie.total_budget_euro')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

</div>
