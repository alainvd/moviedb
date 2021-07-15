@if (empty($print))
<!-- Output for screen -->
<div {{ $attributes->only('class') }}>
    <label for="{{ $id }}" class="block text-sm font-light leading-5 text-gray-700">
        {{ $label }}
        <span class="text-red-500">{{ $isRequired ?? false ? '*' : '' }}</span>
        {{ $slot }}
    </label>

    <div
        @if (!empty($isAmount))
        x-data="{value: @entangle($attributes->wire('model')), value_formatted: ''}"
        x-init="value_formatted = ((typeof value !== 'undefined') && (value !== null)) ? amount(value) : ''"
        @endif
    >

        <!-- default input field -->
        <!-- see more comments in input-trailing.blade.php -->
        <input
            id="{{ $id }}"
            class="block w-full mt-1 py-2 px-3 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasError ?? false ? 'border-red-500': '' }} {{ $disabled ?? false ? 'bg-gray-200': '' }} {{ !empty($isAmount) ? 'hidden' : '' }}"
            {{ $disabled ?? false ? 'disabled' : ''  }}
            {{ $readonly ?? false ? 'readonly' : ''  }}
            {{ $attributes }}
        >

        <!-- formatted amount field -->
        <!-- see more comments in input-trailing.blade.php -->
        @if (!empty($isAmount))
        <input
            id="{{ $id.'_amount' }}"
            class="block w-full mt-1 py-2 px-3 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasError ?? false ? 'border-red-500': '' }} {{ $disabled ?? false ? 'bg-gray-200': '' }} {{ empty($isAmount) ? 'hidden' : '' }}"
            {{ $disabled ?? false ? 'disabled' : ''  }}
            {{ $readonly ?? false ? 'readonly' : ''  }}
            x-model="value_formatted"
            x-on:input="value_formatted = amount(value_formatted); value = unformat_amount(value_formatted);"
        >
        @endif

    </div>
</div>
@endif

@if (!empty($print) && !empty($value))
<!-- Output for print -->
<span class="font-bold">{{ $label }}</span>
<span class="">{!! $value !!}</span>
@endif
