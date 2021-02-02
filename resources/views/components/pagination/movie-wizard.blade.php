@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium cursor-default leading-5">
                <svg class="h-8 w-8 fill-current  text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
            </span>
        @else
            <a href="#" wire:click.prevent="previousPage" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 rounded-md transition ease-in-out duration-150">
                <svg class="h-8 w-8 fill-current text-indigo-600 hover:text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="#" wire:click.prevent="nextPage" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 rounded-md  transition ease-in-out duration-150">
                <svg class="h-8 w-8 fill-current text-indigo-600 hover:text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium cursor-default leading-5">
                <svg class="h-8 w-8 fill-current  text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </span>
        @endif
    </nav>
@endif
