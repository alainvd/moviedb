<form id="fiche-form" wire:submit.prevent="submitFiche">
    <div>
        @if ($layout=='components.ecl-layout')
        <div class="w-full p-4 mx-auto my-4 bg-white rounded-md shadow-md md:px-8 lg:px-16">
        @elseif ($layout=='components.layout')
        <div class="w-full p-4 mx-auto my-4 bg-white rounded-md shadow-md">
        @endif

<div class="flex">
    
    <div class="flex-1">
        <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select a tab</label>
        <select id="tabs" name="tabs" class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option selected>Fiche details</option>
            <option>Award / Prizes</option>
            <option>Links</option>
        </select>
        </div>

        <div class="hidden sm:block">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px space-x-8" aria-label="Tabs">
            <a href="#" class="flex px-1 py-4 text-sm font-medium text-indigo-600 border-b-2 border-indigo-500 whitespace-nowrap" aria-current="page">
                Fiche details
            </a>
    
            <a href="#" class="flex px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-200 whitespace-nowrap">
                Award / Prizes
                <span class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">6</span>
            </a>
    
            <a href="#" class="flex px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-200 whitespace-nowrap">
                Links
                <span class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">6</span>
            </a>
            </nav>
        </div>
        </div>
    </div>

    <div class="flex-none border-b border-gray-200">
    <div class="relative inline-block text-left" x-data="{ open: false }" @click.away="open = false">
        <div>
        <button @click="open = !open" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="menu-button" aria-expanded="true" aria-haspopup="true">
            Dossiers
            <svg class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        </div>

        <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div x-show="open" x-description="Profile dropdown panel, show/hide based on dropdown state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="py-1" role="none">
            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">SEP-612289923</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">SEP-612289923</a>
        </div>
        </div>
    </div>
    </div>

</div>

            {{ $slot }}

            <!-- buttons -->
            @if(empty($print))
            <div id="fiche-form-buttons" class="flex items-center justify-end mt-12 space-x-3 asdf-123 print:hidden">
                @if ($hasHistory && Auth::user()->hasRole('editor'))
                    @if($dossier && $activity && $fiche)
                    <a href="{{ route('fiche-history', [$dossier, $activity, $fiche]) }}" class="block text-indigo-700 text-md hover:text-indigo-400">
                        View history
                    </a>
                    @elseif($fiche)
                    <a href="{{ route('fiche-history-no-dossier', [$fiche]) }}" class="block text-indigo-700 text-md hover:text-indigo-400">
                        View history
                    </a>
                    @endif
                @endif
                @if($isApplicant)
                    @if($standAloneFiche==false)
                        <x-button.primary id="button-save" wire:click="saveFiche">Save as Draft</x-button.primary>
                    @endif
                    <x-button.primary id="button-submit" type="submit">Submit</x-button.primary>
                @elseif($isEditor)
                    <x-button.primary id="button-save" wire:click="saveFiche">Save</x-button.primary>
                @endif
            </div>
            @endif
        </div>
    </div>
</form>
