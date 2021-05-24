@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between align-middle">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a href="#" wire:click.prevent="previousPage" rel="prev" class="relative inline-flex items-center px-4 py-2 text-md text-indigo-500 font-medium leading-5 rounded-md transition ease-in-out duration-150">
                &lt;&lt;&nbsp;&nbsp;
                Previous
            </a>
        @else
            <div class="w-32"></div>
        @endif

        <div class="text-gray-500 text-md self-center">
            Could not find the Movie you are looking for?
            &nbsp;
            <a href="{{ url('/') }}" class="text-indigo-600">
                Create your Movie Fiche
            </a>
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="#" wire:click.prevent="nextPage" rel="next" class="relative inline-flex items-center px-4 py-2 text-md text-indigo-500 font-medium leading-5 rounded-md  transition ease-in-out duration-150">
                Next
                &nbsp;&nbsp;&gt;&gt;
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-md font-medium cursor-default leading-5">
                Next
                &nbsp;&nbsp;&gt;&gt;
            </span>
        @endif
    </nav>
@endif
