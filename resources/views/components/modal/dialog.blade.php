@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4 flex flex-col overflow-hidden h-full">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="flex-1 overflow-auto">
            {{ $content }}
        </div>

        <div class="px-6 py-4 bg-gray-100 text-right" style="height: 60px">
            {{ $footer ?? '' }}
        </div>
    </div>
</x-modal>
