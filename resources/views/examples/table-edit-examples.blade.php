<x-landing-layout>
    <div>
        <p>This is a simple table edit component.</p>
        <p>Elements are saved to database.</p>
        <p>Existing media_id {{ $media_id }} is required.</p>
    </div>

    @livewire('table-edit-example-simple', ['media_id' => $media_id])

    <div>
        <p>Table example component with storing in memory.</p>
        <p>Elements are saved when needed.</p>
        <p>Existing media_id {{ $media_id }} is required.</p>
    </div>

    @livewire('table-edit-example-memory', ['media_id' => $media_id])

</x-landing-layout>
