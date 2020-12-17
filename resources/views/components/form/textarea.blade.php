<label for="{{ $id }}" class="block text-sm font-light leading-5 text-gray-700">
    {{ $label }}
    {{ $slot }}
</label>

<textarea id="{{$id}}"
    class="block w-full h-32 mt-1 py-2 px-3 border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{ $hasError ?? false ? 'border-red-500' : '' }}"
    placeholder="Insert any additional comments"
    {{ $attributes }}>
</textarea>