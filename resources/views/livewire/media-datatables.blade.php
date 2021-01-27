<x-layout>
    <div class="md:py-12">
        <div class="w-full p-8 mx-auto bg-white rounded-md shadow-md md:px-8 lg:px-16 sm:w-11/12">


            <div>
                <h2 class="text-black text-4xl leading-10">Search Media</h2>
            </div>


            <div class="w-full">
                <livewire:media-datatables
                  searchable="title"
                   exportable
                />

            </div>
        </div>

    </div>

</x-layout>
