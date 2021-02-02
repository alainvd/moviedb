<x-layout>
    <div class="">
            <br>
            <br>
            <div>
                <h2 class="text-black text-4xl leading-10">Search Movies</h2>
            </div>
            <br>
            <br>

            <div class="">
                <livewire:movie-datatables
                  searchable="original_title"
                   exportable
                />

            </div>

    </div>

</x-layout>
