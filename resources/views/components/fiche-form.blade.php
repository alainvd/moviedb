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
            <div id="fiche-form-buttons" class="flex items-center justify-end mt-12 space-x-3 print:hidden">
                <x-button.primary id="button-save" wire:click="saveFiche">Save</x-button.primary>
                <x-button.primary id="button-submit" type="submit">Submit</x-button.primary>
            </div>
            @endif
        </div>
    </div>
</form>
