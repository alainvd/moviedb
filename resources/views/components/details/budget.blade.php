<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-budget">

    <div class="col-span-1">
        <x-form.currency-amount
            :idAmount="'total_budget_currency_amount'"
            :labelAmount="'Total Budget'"
            :hasErrorAmount="$errors->has('movie.total_budget_currency_amount')"
            :modelAmount="'movie.total_budget_currency_amount'"
            :idCurrency="'total_budget_currency_code'"
            :labelCurrency="'Currency'"
            :hasErrorCurrency="$errors->has('movie.total_budget_currency_code')"
            :modelCurrency="'movie.total_budget_currency_code'"
            :currencies="$currencies">

        </x-form.currency-amount>

        @error('movie.total_budget_currency_amount')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
        @error('movie.total_budget_currency_code')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    @if($isEditor)
    <div class="col-span-1">
        <x-form.input
            :id="'total_budget_currency_rate'"
            :label="'Conversion rate'"
            :hasError="$errors->has('movie.total_budget_currency_rate')"
            wire:model="movie.total_budget_currency_rate"
            placeholder="0.00">

        </x-form.input>

        @error('movie.total_budget_currency_rate')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    @endif

    @if($isEditor)
    <div class="col-span-1">
        <x-form.input
            :id="'total_budget_euro'"
            :label="'Total budget in EURO'"
            :hasError="$errors->has('movie.total_budget_euro')"
            wire:model="movie.total_budget_euro"
            placeholder="0">

        </x-form.input>

        @error('movie.total_budget_euro')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    @endif

</div>
