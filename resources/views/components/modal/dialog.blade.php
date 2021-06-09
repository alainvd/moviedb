@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="flex flex-col h-full px-6 py-4 overflow-hidden">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="flex-1 overflow-auto">
            {{ $content }}
        </div>

        <div class="px-6 py-4 text-right">
            {{ $footer ?? '' }}
        </div>
    </div>
</x-modal>
