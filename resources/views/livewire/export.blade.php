<div class="mt-4 mb-24 bg-white p-4 w-full md:w-1/2 mx-auto">
    <h1 class="mb-4 text-2xl font-medium leading-tight">EXPORT</h1>
    <form wire:submit.prevent="submit">
        <div class="w-full my-2">
            @livewire('select-component', [
                'ref' => 'selectedActions',
                'domId' => 'selected-actions',
                'label' => 'ACTION',
                'isRequired' => false,
                'name' => 'selectedActions',
                'options' => json_encode($actions),
                'items' => json_encode($selectedActions)
            ])
        </div>

        <div class="w-full my-2">
            @livewire('select-component', [
                'ref' => 'selectedCalls',
                'domId' => 'selected-calls',
                'label' => 'TOPIC',
                'isRequired' => false,
                'name' => 'selectedCalls',
                'options' => json_encode($calls),
                'items' => json_encode($selectedCalls)
            ])
        </div>

        <div class="w-full my-2">
            @livewire('select-component', [
                'ref' => 'selectedStatuses',
                'domId' => 'selected-statuses',
                'label' => 'STATUS',
                'isRequired' => false,
                'name' => 'selectedStatuses',
                'options' => json_encode($statuses),
                'items' => json_encode($selectedStatuses)
            ])
        </div>

        <div class="my-2">
            <x-form.input class="w-1/2" :id="'year'" :label="'WORK PROGRAM YEAR'" wire:model.defer="year"></x-form.input>
        </div>

        <x-form.datepicker :id="'from'" :label="'CREATED STARTING AT'" wire:model.defer="from"></x-form.datepicker>

        <x-form.datepicker :id="'to'" :label="'CREATED UNTIL'" wire:model.defer="to"></x-form.datepicker>

        <label class="block mt-4 mb-2 text-sm font-light uppercase leading-tight text-gray-700" for="export-type">what to export</label>
        <div id="export-type" class="flex w-full mb-4">
            <button
                type="button"
                class="text-base w-1/2 rounded-r-none  hover:scale-110 focus:outline-none inline-flex justify-center px-4 py-4 rounded font-bold cursor-pointer hover:bg-indigo-600 hover:text-white border duration-200 ease-in-out border-gray-600 transition {{ $exportFiches ? 'bg-white text-gray-700' : 'bg-indigo-600 text-white' }}"
                wire:click="$set('exportFiches', false)">
                <div class="flex leading-5 uppercase">Dossiers</div>
            </button>
            <button
                data-cy="export-fiches"
                type="button"
                class="text-base w-1/2 rounded-l-none border-l-0  hover:scale-110 focus:outline-none inline-flex justify-center px-4 py-4 rounded font-bold cursor-pointer hover:bg-indigo-600 hover:text-white border duration-200 ease-in-out border-gray-600 transition {{ $exportFiches ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700' }}"
                wire:click="$set('exportFiches', true)">
                <div class="flex leading-5 uppercase">Fiches</div>
            </button>
        </div>

        <div class="export-buttons flex justify-end">
            <x-button.primary type="submit">Export</x-button.primary>
            <x-button.secondary class="ml-4" wire:click="clearFields">Clear</x-button.secondary>
        </div>
    </form>
</div>
