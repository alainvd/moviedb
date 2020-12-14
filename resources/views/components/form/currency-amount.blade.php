<div>
    <label for="{{ $idAmount }}" class="block text-sm font-light leading-5 text-gray-700">
        {{ $labelAmount }}
    </label>
    <div class="mt-1 relative rounded-md shadow-sm">
        <input 
            type="text"
            name="{{ $idAmount }}"
            id="{{ $idAmount }}"
            class="block w-full mt-1 py-2 px-3 border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            placeholder="0"
            wire:model="{{ $modelAmount }}"
        >
        <div class="absolute inset-y-0 right-0 flex items-center">
            <label for="{{ $idCurrency }}" class="sr-only">{{ $labelCurrency }}</label>
            <select
                id="{{ $idCurrency }}"
                name="{{ $idCurrency }}"
                class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 mr-2 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                wire:model="{{ $modelCurrency }}"
            >
                @foreach($currencies as $code => $currency)
                <option value="{{ $code }}">{{ $code }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>                  

@error('movie.total_budget_currency_amount')
    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
@enderror
@error('movie.total_budget_currency_code')
    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
@enderror