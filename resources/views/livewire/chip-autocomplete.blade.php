<label for="{{ $domId }}" class="block text-sm font-light leading-5 text-gray-700">
    {{ $label }}
</label>

<div id="{{ $domId }}" class="w-full border border-gray-300 relative mt-1 py-2 px-3 rounded-md shadow-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out">
    @if(count($selected))

    <div class="inline-block">
        @foreach($selected as $item)
        <livewire:chip wire:key="{{$loop->index}}" :key="$item" :label="$item" :canRemove="true" />
        @endforeach
    </div>

    @endif
    <x-input-dropdown>
        <x-slot name="trigger">
            <input type="text" wire:model="search" class="w-full inline border-none outline-none bg-white">
        </x-slot>

        <ul class="w-full overflow-y-auto list-none bg-white rounded-lg absolute left-0 -bottom-2" style="max-height: 260px">

            @forelse($options as $option)

            <li wire:key="{{$loop->index}}" wire:click="$emit('addItem', '{{$option['chipLabel'] ?? $option['label']}}')" class="p-4 text-md leading-tight font-normal hover:bg-gray-300 cursor-pointer">
                {{ $option['label'] }}
            </li>

            @empty

            <li class="p-4 text-md leading-tight font-normal hover:bg-gray-300 cursor-pointer">
                No results found
            </li>

            @endforelse
        </ul>
    </x-input-dropdown>
</div>
