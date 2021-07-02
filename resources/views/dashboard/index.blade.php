<x-layout :title="$title">
    <x-slot name="slotAbove">
        <div class="mt-8">
            @include('livewire.dashboard.dials')
        </div>
    </x-slot>
    <div class="mt-8 overflow-hidden">
        <h3 class="text-xl tracking-tight leading-normal font-thin">Weekly data</h3>
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-1 h-64">
                <livewire:livewire-column-chart :column-chart-model="$dossiersPerDayChart" />
            </div>
            <div class="col-span-1 h-64">
                <livewire:livewire-column-chart :column-chart-model="$applicantsPerDayChart" />
            </div>
        </div>

        <h3 class="text-xl tracking-tight leading-normal font-thin">Actions data</h3>
        <div class="w-full" style="height: 600px">
            <livewire:livewire-pie-chart
                :pie-chart-model="$actionsChart"
            />
        </div>
    </div>

    @livewireChartsScripts
</x-layout>
