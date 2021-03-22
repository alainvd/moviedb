<x-modal.confirmation {{ $attributes->whereStartsWith('wire:model') }}>
    <x-slot name="title">{{ $title ?? 'Delete modal' }}</x-slot>

    <x-slot name="content">
        <div class="py-8 text-xl">
            {{ $content ?? 'Modal content' }}
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="flex justify-end items-center space-x-3">
            {{dd($attributes->whereStartsWith('wire:click'))}}
            <x-anchors.primary>OK</x-anchors.primary>
            <x-anchors.secondary">Cancel</x-button.secondary>
        </div>
    </x-slot>
</x-modal.confirmation>
