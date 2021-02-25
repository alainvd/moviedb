@if (isset($disabled) && $disabled)
    <a
        class="inline-flex items-center px-3 py-2 border border-gray-600 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-indigo-50 focus:outline-none focus:border-gray-600 focus:shadow-outline-indigo active:bg-indigo-200 transition ease-in-out duration-150 cursor-not-allowed opacity-50">
        {{ $slot }}
    </a>
@else
    <a
        class="inline-flex items-center px-3 py-2 border border-gray-600 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-indigo-50 focus:outline-none focus:border-gray-600 focus:shadow-outline-indigo active:bg-indigo-200 transition ease-in-out duration-150"
        href="{{ $url }}">
        {{ $slot }}
    </a>
@endif
