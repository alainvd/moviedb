<label for="{{ $id }}" class="block text-sm font-light leading-5 text-gray-700">
    {{ $label }}
    <span class="text-red-500">{{ $isRequired ?? false ? '*' : '' }}</span>
</label>

<!-- Output for screen -->
@if (empty($print))
<select
    id="{{ $id }}"
    class="mt-1 block form-select w-full max-w-full md:w-auto p-2 pr-8 border border-gray-300 bg-white rounded-md shadow-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasError ?? false ? 'border-red-500' : '' }} {{ $disabled ?? false ? 'bg-gray-200': '' }}"
    {{ $disabled ?? false ? 'disabled' : ''  }}
    {{ $attributes }}>
    <option value="">Choose an option</option>
    {{ $slot }}
</select>
@endif

<!-- Output for print -->
@if (!empty($print) && !empty($value))
<span class="hidden">{{ $value }}</span>
@endif