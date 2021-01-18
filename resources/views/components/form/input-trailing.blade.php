<label for="{{ $id }}" class="block text-sm font-light leading-5 text-gray-700">
    {{ $label }}
    {{ $slot }}
</label>

<div class="relative mt-1 rounded-md shadow-sm">
    <input
        id="{{ $id }}"
        class="block w-full mt-1 py-2 px-3 border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasError ?? false ? 'border-red-500': '' }}"
        {{ $attributes }}>
    <div
        class="absolute inset-y-0 right-0 flex items-center h-full py-0 pl-2 mr-2 text-gray-500 bg-transparent border-transparent rounded-md pr-7 sm:text-sm">
        {{ $trailing }}
    </div>
</div>