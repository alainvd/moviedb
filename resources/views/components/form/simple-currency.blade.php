<div>
    <label for="{{ $id ?? 'currency' }}" class="block text-sm font-light leading-5 text-gray-700">
        {{ $label }}
    </label>

    <!-- Output for screen -->
    @if (empty($print))
    <div class="relative mt-1 rounded-md shadow-sm">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <span class="text-gray-500 sm:text-sm">
                €
            </span>
        </div>
        <input
            type="numeric"
            min="1"
            step="any"
            id="{{ $id ?? 'currency' }}"
            class="block w-full mt-1 py-2 px-3 pl-8 border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasError ?? false ? 'border-red-500': '' }}"
            placeholder="0.00"
            {{ $attributes }}>
    </div>
    @endif

    <!-- Output for print -->
    @if (!empty($print) && !empty($value))
    <span class="inline-block">€ {{ $value }}</span>
    @endif
</div>
