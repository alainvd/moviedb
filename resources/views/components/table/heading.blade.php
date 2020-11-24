<th {{ $attributes->merge(['class' => 'px-6 py-3 bg-cool-gray-50'])->only('class') }}>
    <span class="text-left text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider">{{ $slot }}</span>
</th>