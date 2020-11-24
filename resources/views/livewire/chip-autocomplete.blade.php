<div class="w-full p-2 bg-white border-b-2 border-gray-900 relative">

    @if(count($selected))

    <div class="inline-block">
        @foreach($selected as $key => $item)

        <livewire:chip :key="$key" :label="$item" :canRemove="true" />

        @endforeach
    </div>

    @endif
    <x-input-dropdown>
        <x-slot name="trigger">
            <input type="text" wire:model="search" class="w-full inline p-2 border-none outline-none bg-white">
        </x-slot>

        <ul class="w-full overflow-y-auto list-none bg-white rounded-lg absolute left-0 -bottom-2" style="max-height: 250px">

            @foreach($options as $option)

            <li wire:click="addItem('{{ $option }}')" class="p-4 text-md leading-tight font-normal hover:bg-gray-300 cursor-pointer">
{{$loop->index}} - {{ $option }}
            </li>

            @endforeach
        </ul>
    </x-input-dropdown>
</div>
