<span x-data="{ open: false }">
    <span @click="open = true">
        {{ $trigger }}
    </span>

    <span x-show="open" @click="open = false" @click.away="open = false">
        {{ $slot }}
    </span>
</span>
