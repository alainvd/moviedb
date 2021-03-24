<x-modal {{ $attributes }}>
    <div class="p-8">
        @if (count($changes))
            @if ($changes->has('old'))
                <h3 class="my-4 text-xl font-semibold leading-tight text-gray-900">
                    Old values
                </h3>
                @foreach ($changes['old'] as $key => $value)
                    <label for="{{ $key }}" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        {{ $key }}
                    </label>
                    <div class="w-1/2 py-2 px-4 mb-4 border rounded-md bg-gray-300 text-gray-700 leading-tight text-sm 0" id="{{ $key }}">
                        {{ $value ?? 'No value' }}
                    </div>
                @endforeach
            @endif

            @if ($changes->has('attributes'))
                <h3 class="my-4 text-xl font-semibold leading-tight text-gray-900">
                    New values
                </h3>
                @foreach ($changes['attributes'] as $key => $value)
                    <label for="{{ $key }}" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        {{ $key }}
                    </label>
                    <div class="w-1/2 py-2 px-4 mb-4 border rounded-md bg-gray-300 text-gray-700 leading-tight text-sm 0" id="{{ $key }}">
                        {{ $value ?? 'No value' }}
                    </div>
                @endforeach
            @endif

            @if ($changes->has('movie'))
                <h3 class="my-4 text-xl font-semibold leading-tight text-gray-900">
                    Movie details
                </h3>
                @foreach ($changes['movie'] as $key => $value)
                    @if (!is_array($value))
                        <label for="{{ $key }}" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            {{ $key }}
                        </label>
                        <div class="w-1/2 py-2 px-4 mb-4 border rounded-md bg-gray-300 text-gray-700 leading-tight text-sm 0" id="{{ $key }}">
                            {{ $value ?? 'No value' }}
                        </div>
                    @endif
                @endforeach
            @endif
        @endif
    </div>
</x-modal>
