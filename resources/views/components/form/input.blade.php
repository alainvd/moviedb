<label for="{{ $id }}" class="block text-sm font-light leading-5 text-gray-700">
    {{ $label }}
    {{ $slot }}
</label>

<input
    id="{{ $id }}"
    class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
    {{ $attributes }}>
