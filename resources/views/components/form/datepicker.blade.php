@if (empty($print))
<!-- Output for screen -->
<label for="{{ $id }}" class="block text-sm font-light leading-5 text-gray-800">
    {{ $label }}
    <span class="text-red-500">{{ $isRequired ?? false ? '*' : '' }}</span>
</label>

<div
    x-data=""
    @if($attributes['id'] == 'sales_distributors_release_date')
    @elseif($attributes['id'] == 'distributors-forecast-release-date')
    {{-- livewire modal datepickers are inited and destroyed in respective templates --}}
    @else
    x-init="new Pikaday({
        field: $refs.input,
        theme: 'moviedb-theme',
        format: 'DD.MM.YYYY',
        firstDay: 1,
    })"
    @endif
    @change="$dispatch('input', $event.target.value)"
    class="relative"
>
    <input
        {{ $attributes }}
        x-ref="input"
        placeholder="DD.MM.YYYY"
        class="my-2 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasError ?? false ? 'border-red-500': '' }} {{ $disabled ?? false ? 'bg-gray-200': '' }}"
        autocomplete="off"
        {{ $disabled ?? false ? 'disabled' : ''  }}
        readonly="readonly"
    />

    <div class="absolute top-0 right-0 px-3 py-2">
        <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </div>
</div>
@endif

@if (!empty($print) && !empty($value))
<!-- Output for print -->
<span class="font-bold">{{ $label }}</span>
<span class="">{{ $value ? date('d.m.Y', strtotime($value)) : '' }}</span>
@endif
