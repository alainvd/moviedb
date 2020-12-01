<span class="px-2 py-1 mr-1 mb-1 inline-block rounded-full bg-gray-300 hover:bg-gray-500 text-gray-900 text-xs">
    {{ $label }}

    @if($canRemove)

    <a  href="#"
        class="no-underline"
        wire:click.prevent="remove">

        <svg class="inline fill-current text-gray-900 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>

    </a>

    @endif
</span>
