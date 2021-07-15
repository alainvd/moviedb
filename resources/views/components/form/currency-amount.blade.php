<div>
    @if (empty($print))
    <!-- Output for screen -->
    <label for="{{ $idAmount }}" class="block text-sm font-light leading-5 text-gray-700">
        {{ $labelAmount }}
        <span class="text-red-500">{{ $isRequired ?? false ? '*' : '' }}</span>
    </label>

    <div
        @if (!empty($isAmount))
        x-data="{value: @entangle($attributes->wire('model')), value_formatted: ''}"
        x-init="value_formatted = ((typeof value !== 'undefined') && (value !== null)) ? amount(value) : '';"
        @endif
        class="relative mt-1 rounded-md shadow-sm">

        <!-- default input field -->
        <!-- see more comments in input-trailing.blade.php -->
        <input 
            id="{{ $idAmount }}"
            class="block w-full mt-1 py-2 px-3 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasErrorAmount||$hasErrorCurrency ?? false ? 'border-red-500': '' }} {{ $disabled ?? false ? 'bg-gray-200': '' }} {{ !empty($isAmount) ? 'hidden' : '' }}"
            placeholder="0"
            wire:model="{{ $modelAmount }}"
            {{ $disabled ?? false ? 'disabled' : ''  }}
        >

        <!-- formatted amount field -->
        <!-- see more comments in input-trailing.blade.php -->
        @if (!empty($isAmount))
        <input 
            id="{{ $idAmount.'_amount' }}"
            class="block w-full mt-1 py-2 px-3 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasErrorAmount||$hasErrorCurrency ?? false ? 'border-red-500': '' }} {{ $disabled ?? false ? 'bg-gray-200': '' }} {{ empty($isAmount) ? 'hidden' : '' }}"
            placeholder="0"
            {{ $disabled ?? false ? 'disabled' : ''  }}
            x-model="value_formatted"
            x-on:input="value_formatted = amount(value_formatted); value = unformat_amount(value_formatted);"
        >
        @endif

        <!-- currency selector -->
        <div class="absolute inset-y-0 right-0 flex items-center">
            <label for="{{ $idCurrency }}" class="sr-only">{{ $labelCurrency }}</label>
            <select
                id="{{ $idCurrency }}"
                name="{{ $idCurrency }}"
                class="h-full py-0 pl-2 mr-2 text-gray-500 bg-transparent border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 pr-7 sm:text-sm"
                wire:model="{{ $modelCurrency }}"
                {{ $disabled ?? false ? 'disabled' : ''  }}
            >
                @foreach($currencies as $code => $currency)
                <option value="{{ $code }}">{{ $code }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    @if (!empty($print) && !empty($value))
    <!-- Output for print -->
    <span class="font-bold">{{ $labelAmount }}</span>
    <span class="">{{ $value }}</span>
    @endif
</div>                  