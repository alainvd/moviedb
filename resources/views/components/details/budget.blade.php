<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-budget">

    <div class="col-span-1">
        <x-form.currency-amount
            :print="$print"
            :idAmount="'total_budget_currency_amount'"
            :labelAmount="'Total Production Budget'"
            :hasErrorAmount="$errors->has('movie.total_budget_currency_amount')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.total_budget_currency_amount')"
            :modelAmount="'movie.total_budget_currency_amount'"
            :idCurrency="'total_budget_currency_code'"
            :labelCurrency="'Currency'"
            :hasErrorCurrency="$errors->has('movie.total_budget_currency_code')"
            :modelCurrency="'movie.total_budget_currency_code'"
            :currencies="$currencies"
            value="{{ amount($movie->total_budget_currency_amount) }} {{ $movie->total_budget_currency_code }}"
        ></x-form.currency-amount>

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
            :print="$print"
            :id="'total_budget_currency_rate'"
            :label="'Conversion Rate'"
            :hasError="$errors->has('movie.total_budget_currency_rate')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.total_budget_currency_rate')"
            wire:model="movie.total_budget_currency_rate"
            placeholder="0.00"
            value="{{ $movie->total_budget_currency_rate }}"
        ></x-form.input>

        @error('movie.total_budget_currency_rate')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    @endif

    @if($isEditor)
    <div class="col-span-1">
        <x-form.input
            :print="$print"
            :id="'total_budget_euro'"
            :label="'Total Production Budget in EURO'"
            :hasError="$errors->has('movie.total_budget_euro')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.total_budget_euro')"
            wire:model="movie.total_budget_euro"
            placeholder="0"
            value="{{ $movie->total_budget_euro }}"
        ></x-form.input>

        @error('movie.total_budget_euro')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    @endif

</div>
