<form id="fiche-form" wire:submit.prevent="submitFiche">
    <div>
        @if ($layout=='components.ecl-layout')
        <div class="w-full p-4 mx-auto my-4 bg-white rounded-md shadow-md md:px-8 lg:px-16">
        @elseif ($layout=='components.layout')
        <div class="w-full p-4 mx-auto my-4 bg-white rounded-md shadow-md">
        @endif

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
