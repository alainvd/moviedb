@if (isset($disabled) && $disabled)
    <a {{ $attributes->merge(['class' => 'inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150 opacity-50 cursor-not-allowed'])}}>
        {{ $slot  }}
    </a>
@else
    <a {{ $attributes->merge(['class' => 'inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150'])}} href="{{ $url }}">
        {{ $slot  }}
    </a>
@endif
