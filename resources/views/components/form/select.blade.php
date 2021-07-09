@if (empty($print))
<!-- Output for screen -->
<div {{ $attributes->only('class') }}>
    <label for="{{ $id }}" class="block text-sm font-light leading-5 text-gray-700">
        {{ $label }}
        <span class="text-red-500">{{ $isRequired ?? false ? '*' : '' }}</span>
    </label>

    <select
        id="{{ $id }}"
        class="mt-1 block form-select w-full max-w-full md:w-auto p-2 pr-8 border border-gray-300 bg-white rounded-md shadow-md focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasError ?? false ? 'border-red-500' : '' }} {{ $disabled ?? false ? 'bg-gray-200': '' }}"
        {{ $disabled ?? false ? 'disabled' : ''  }}
        {{ $attributes }}>
        @if(!(isset($noEmptyValue) && $noEmptyValue==true))
        <option value="">{{ $emptyValueLabel ?? 'Choose an option'}}</option>
        @endif
        {{ $slot }}
    </select>
</div>
@endif

@if (!empty($print) && !empty($value))
<!-- Output for print -->
<span class="font-bold">{{ $label }}</span>
<span class="">{!! $value !!}</span>
@endif
