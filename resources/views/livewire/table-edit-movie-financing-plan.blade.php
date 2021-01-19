<div>
    
    <div class="mb-8 text-lg">
        Film Financing Plan
    </div>

    <div>
        <x-table>
            <x-slot name="head">
                <x-table.heading>Document Type</x-table.heading>
                <x-table.heading>Filename</x-table.heading>
                <x-table.heading>Comments</x-table.heading>
                <x-table.heading></x-table.heading>
            </x-slot>
            
            <x-slot name="body">
                @foreach ($items as $item)
                <x-table.row>
                    <x-table.cell class="text-center">{{ $item['document_type'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['filename'] }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $item['comments'] }}</x-table.cell>
                    <x-table.cell class="space-x-2 text-center">
                        <a wire:click="showModalEdit('{{ $item['key'] }}')" class="cursor-pointer">Edit</a>
                        <a wire:click="showModalDelete('{{ $item['key'] }}')" class="cursor-pointer">Delete</a>
                    </x-table.cell>
                </x-table.row>
                @endforeach
            </x-slot>
        </x-table>

        <div class="mt-5 text-right">
            <x-button.secondary wire:click="showModalAdd" wire:loading.attr="disabled">
                Add
            </x-button.secondary>
        </div>
    </div>

    <form class="space-y-2">
        <x-modal.dialog wire:model="showingEditModal">
            <x-slot name="title">
                Add/Edit financing plan
            </x-slot>

            <x-slot name="content">
                <div class="space-y-2">

                    <div>
                        <x-form.input
                            :id="'financing_document_type'"
                            :label="'Document Type'"
                            :hasError="$errors->has('editing.document_type')"
                            wire:model="editing.document_type">
                        </x-form.input>

                        @error('editing.document_type')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.input
                            :id="'financing_filename'"
                            :label="'Filename'"
                            :hasError="$errors->has('editing.filename')"
                            wire:model="editing.filename">
                        </x-form.input>

                        @error('editing.filename')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-form.input
                            :id="'financing_comments'"
                            :label="'Comments'"
                            :hasError="$errors->has('editing.comments')"
                            wire:model="editing.comments">
                        </x-form.input>

                        @error('editing.comments')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    
                </div>
                
                <div class="flex items-center justify-end mt-4 space-x-3">
                    <x-button.primary wire:click="saveItem">Save</x-button.primary>

                    <x-button.secondary wire:click="$set('showingEditModal', false)">Cancel</x-button.secondary>
                </div>
            </x-slot>

            <x-slot name="footer">
            </x-slot>
        </x-modal.dialog>
    </form>

    <form wire:submit.prevent="deleteItem">
        <x-modal.confirmation wire:model.defer="showingDeleteModal">
            <x-slot name="title">Delete financingplan</x-slot>

            <x-slot name="content">
                <div class="py-8">Do you want to remove this financing plan?</div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex items-center justify-end space-x-3">
                    <x-button.primary type="submit">Delete</x-button>

                    <x-button.secondary wire:click="$set('showingDeleteModal', false)">Cancel</x-button>
                </div>
            </x-slot>
        </x-modal.confirmation>
    </form>

</div>
