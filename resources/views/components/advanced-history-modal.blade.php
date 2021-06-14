<x-modal.dialog {{ $attributes }}>
    <x-slot name="title">
        Fiche history
    </x-slot>

    <x-slot name="content">
        @if (count($changes))
            <div class="w-full grid grid-cols-2 gap-4">
                @if ($changes->has('old'))
                    <div class="col-span-1">
                        <h3 class="my-4 text-xl font-semibold leading-tight text-gray-900">
                            Old values
                        </h3>
                        @foreach ($changes['old'] as $key => $value)
                            <label for="{{ $key }}" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                {{ $this->getLabel($key) }}
                            </label>
                            <div class="py-2 px-4 mb-4 border rounded-md bg-gray-300 text-gray-700 leading-tight text-sm 0" id="{{ $key }}">
                                {{ $value ? $this->getValue($key, $value) : '-' }}
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($changes->has('attributes'))
                    <div class="col-span-1">
                        <h3 class="my-4 text-xl font-semibold leading-tight text-gray-900">
                            New values
                        </h3>
                        @foreach ($changes['attributes'] as $key => $value)
                            <label for="{{ $key }}" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                {{ $this->getLabel($key) }}
                            </label>
                            <div class="py-2 px-4 mb-4 border rounded-md bg-gray-300 text-gray-700 leading-tight text-sm 0" id="{{ $key }}">
                                {{ $value ? $this->getValue($key, $value) : '-' }}
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($changes->has('movie'))
                <h3 class="my-4 text-xl font-semibold leading-tight text-gray-900">
                    Movie details
                </h3>
                @foreach ($changes['movie'] as $key => $value)
                    @if (!is_array($value) && $value)
                        <label for="{{ $key }}" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            {{ $this->getLabel($key) }}
                        </label>
                        <div class="w-3/4 py-2 px-4 mb-4 border rounded-md bg-gray-300 text-gray-700 leading-tight text-sm 0" id="{{ $key }}">
                            {{ $value ? $this->getValue($key, $value) : '-' }}
                        </div>
                    @endif
                @endforeach
            @endif
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-button.secondary wire:click="$set('showViewChanges', false)">Close</x-button.secondary>
    </x-slot>
</x-modal.dialog>
