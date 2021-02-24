@props([
    'sortable' => null,
    'direction' => null,
])

<th {{ $attributes->merge(['class' => 'p-2 bg-gray-300'])->only('class') }}>
    @unless ($sortable)
        <span class="text-left text-xs leading-4 font-light text-cool-gray-500 uppercase tracking-wider">{{ $slot }}</span>
    @else
        <button {{ $attributes->except('class') }}
            class="group flex items-center align-middle text-left text-xs font-light text-cool-gray-500 uppercase tracking-wider outline-none active:outline-none focus:outline-none">
            <span class="block">{{ $slot }}</span>

            <span class="block">
                @if ($direction === 'asc')
                    <svg class="w-2 h-2" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor">
                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                @elseif ($direction === 'desc')
                    <svg class="w-2 h-2" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                @else
                    <svg class="w-2 h-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                @endif
            </span>
        </button>
    @endunless
</th>
