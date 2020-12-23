<div class="my-8">
    <!-- Distributor counts -->
    <input type="hidden" name="coordinator_count" value="0">
    <input type="hidden" name="participant_count" value="0">

    <h3 class="text-lg leading-tight font-normal">
        Distributors Participating in the Grouping
    </h3>
    <x-table class="{{ $errors->has('coordinator_count') || $errors->has('participant_count') ? 'border border-red-500' : '' }}">
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

    @error('coordinator_count')
        <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
    @enderror

    @error('participant_count')
        <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
    @enderror

    <div class="mt-5 text-right">
        <x-anchors.secondary :url="''">
            Add
        </x-anchors.secondary>
    </div>
</div>
