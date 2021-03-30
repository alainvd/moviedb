@if (empty($print))
<!-- Output for screen -->
<label for="{{ $id }}" class="block text-sm font-light leading-5 text-gray-700">
    {{ $label }}
    <span class="text-red-500">{{ $isRequired ?? false ? '*' : '' }}</span>
    {{ $slot }}
</label>
<input
    id="{{ $id }}"
    class="block w-full mt-1 py-2 px-3 border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasError ?? false ? 'border-red-500': '' }} {{ $disabled ?? false ? 'bg-gray-200': '' }}"
    {{ $disabled ?? false ? 'disabled' : ''  }}
    {{ $readonly ?? false ? 'readonly' : ''  }}
    {{ $attributes }}>
@endif

@if (!empty($print) && !empty($value))
<!-- Output for print -->
<span class="font-bold">{{ $label }}</span>
<span class="">{{ $value }}</span>
@endif