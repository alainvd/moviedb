<form wire:submit.prevent="submit">
    <div>
        @if ($layout=='components.ecl-layout')
        <div class="w-full p-4 mx-auto my-4 bg-white rounded-md shadow-md md:px-8 lg:px-16">
        @elseif ($layout=='components.layout')
        <div class="w-full p-4 mx-auto my-4 bg-white rounded-md shadow-md">
        @endif
        
            {{ $slot }}

            <!-- buttons -->
            <div class="flex items-center justify-end mt-12 space-x-3">
                <div x-data class="flex items-center justify-end space-x-3">
                    <x-button.primary id="button-save" wire:click="saveFiche()" x-show="($wire.fiche.status_id==1 || $wire.isEditor==1)">Save</x-button.primary>
                    <x-button.primary id="button-submit" wire:click="submitFiche()">Submit</x-button.primary>
                </div>
            </div>
        </div>
    </div>
</form>
