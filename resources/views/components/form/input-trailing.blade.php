@if (empty($print))
<!-- Output for screen -->
<label for="{{ $id }}" class="block text-sm font-light leading-5 text-gray-700">
    {{ $label }}
    <span class="text-red-500">{{ $isRequired ?? false ? '*' : '' }}</span>
</label>

<div
    @if (!empty($isAmount))
    x-data="{value: @entangle($attributes->wire('model')), value_formatted: ''}"
    x-init="value_formatted = ((typeof value !== 'undefined') && (value !== null)) ? amount(value) : ''"
    @endif
    class="relative mt-1 rounded-md shadow-sm">

    <!-- default input field, for simple values -->
    <!-- hidden if we want to show and edit formatted number value (thousands separated by dot: 1.000) -->
    <input
        id="{{ $id }}"
        class="block w-full mt-1 py-2 px-3 border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasError ?? false ? 'border-red-500': '' }} {{ $disabled ?? false ? 'bg-gray-200': '' }} {{ !empty($isAmount) ? 'hidden' : '' }}"
        {{ $disabled ?? false ? 'disabled' : ''  }}
        {{ $attributes }}
    >

    <!-- editing field for formatted amount values -->
    <!-- no attributes are passed, to skip wire:model -->
    <!-- how does it work: -->
    <!--  * a variable 'value' is entangled with livewire model -->
    <!--  * formatted value is initialized from original value -->
    <!--  * when formatted value changes, original value is updated too -->
    @if (!empty($isAmount))
    <input
        id="{{ $id.'_amount' }}"
        class="block w-full mt-1 py-2 px-3 border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasError ?? false ? 'border-red-500': '' }} {{ $disabled ?? false ? 'bg-gray-200': '' }} {{ empty($isAmount) ? 'hidden' : '' }}"
        {{ $disabled ?? false ? 'disabled' : ''  }}
        x-model="value_formatted"
        x-on:input="value_formatted = amount(value_formatted); value = unformat_amount(value_formatted);"
    >
    @endif

    <div
        class="absolute inset-y-0 right-0 flex items-center h-full py-0 pl-2 mr-2 text-gray-500 bg-transparent border-transparent rounded-md pr-7 sm:text-sm">
        {{ $trailing }}
    </div>
</div>
@endif

@if (!empty($print) && !empty($value))
<!-- Output for print -->
<span class="font-bold">{{ $label }}</span>
<span class="">{!! $isAmount ? amount($value) : $value !!} {!! $trailing !!}</span>
@endif