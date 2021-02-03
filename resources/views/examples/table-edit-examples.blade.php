<x-landing-layout>
    <div>
        <p>This is a simple table edit component.</p>
        <p>Elements are saved to database.</p>
        <p>Existing movie_id {{ $movie_id }} is required.</p>
    </div>

    @livewire('table-edit-example-simple', ['movie_id' => $movie_id])

    <div>
        <p>Table example component with storing in memory.</p>
        <p>Elements are saved when needed.</p>
        <p>Existing movie_id {{ $movie_id }} is required.</p>
    </div>

    @livewire('table-edit-example-memory', ['movie_id' => $movie_id])

</x-landing-layout>
