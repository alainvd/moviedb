<div class="my-8">
    <h3 class="text-lg leading-tight font-normal">
        Distributors Participating in the Grouping
    </h3>
    <x-table>
        <x-slot name="head">
            <x-table.heading>DISTRIBUTION COUNTRY</x-table.heading>
            <x-table.heading>COMPANY NAME</x-table.heading>
            <x-table.heading>COMPANY ROLE</x-table.heading>
            <x-table.heading>FORECAST RELEASE DATE</x-table.heading>
            <x-table.heading>FORECAST BUDGET</x-table.heading>
            <x-table.heading>&nbsp;</x-table.heading>
        </x-slot>

        <x-slot name="body">
            <x-table.row>
                <x-table.cell class="text-center" colspan="5">No distributors yet</x-table.cell>
            </x-table.row>
        </x-slot>
    </x-table>
    <div class="mt-5 text-right">
        <x-anchors.secondary :url="''">
            Add
        </x-anchors.secondary>
    </div>
</div>
