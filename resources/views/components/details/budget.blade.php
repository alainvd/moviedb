<div class="grid grid-cols-2 md:grid-cols-3 gap-4">

    <div class="col-span-1">
        <x-form.currency-amount
            :idAmount="'total_budget_currency_amount'"
            :labelAmount="'Total Budget'"
            :modelAmount="'movie.total_budget_currency_amount'"
            :idCurrency="'total_budget_currency_code'"
            :labelCurrency="'Currency'"
            :modelCurrency="'movie.total_budget_currency_code'"
            :currencies="$currencies">

        </x-form.currency-amount>
    </div>

    <div class="col-span-1">
        <x-form.input
            :id="'total_budget_currency_rate'"
            :label="'Conversion rate'"
            wire:model="movie.total_budget_currency_rate"
            placeholder="0.00">

        </x-form.input>
    </div>

    <div class="col-span-1">
        <x-form.input
            :id="'total_budget_euro'"
            :label="'Total budget in EURO'"
            wire:model="movie.total_budget_euro"
            placeholder="0">

        </x-form.input>
    </div>

</div>
