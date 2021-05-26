@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between align-middle">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a href="#" wire:click.prevent="previousPage" rel="prev" class="relative inline-flex items-center px-4 py-2 font-medium leading-5 text-indigo-500 transition duration-150 ease-in-out rounded-md text-md">
                &lt;&lt;&nbsp;&nbsp;
                Previous
            </a>
        @else
            <div class="w-32"></div>
        @endif

        <div class="self-center text-gray-500 text-md">
            Could not find the Movie you are looking for?
            &nbsp;
            <a href="{{ route('movie-dist') }}" class="text-indigo-600">
                Create your Movie Fiche
            </a>
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="#" wire:click.prevent="nextPage" rel="next" class="relative inline-flex items-center px-4 py-2 font-medium leading-5 text-indigo-500 transition duration-150 ease-in-out rounded-md text-md">
                Next
                &nbsp;&nbsp;&gt;&gt;
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 font-medium leading-5 cursor-default text-md">
                Next
                &nbsp;&nbsp;&gt;&gt;
            </span>
        @endif
    </nav>
@endif
