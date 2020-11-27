<th {{ $attributes->merge(['class' => 'p-2 bg-gray-300'])->only('class') }}>
    <span class="text-left text-xs leading-4 font-light text-cool-gray-500 uppercase tracking-wider">{{ $slot }}</span>
</th>
