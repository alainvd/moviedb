<x-layout :title="$title">
    <x-slot name="slotAbove">
        <div class="mt-8">
            @include('livewire.dashboard.dials')
        </div>
    </x-slot>
    <div class="mt-8 overflow-hidden">
        <h3 class="text-xl leading-normal tracking-tight font-extralight">Weekly data</h3>
        <div class="grid grid-cols-2 gap-4">
            <div class="h-64 col-span-1">
                <livewire:livewire-column-chart :column-chart-model="$dossiersPerDayChart" />
            </div>
            <div class="h-64 col-span-1">
                <livewire:livewire-column-chart :column-chart-model="$applicantsPerDayChart" />
            </div>
        </div>

        <h3 class="text-xl leading-normal tracking-tight font-extralight">Actions data</h3>
        <div class="w-full" style="height: 600px">
            <livewire:livewire-pie-chart
                :pie-chart-model="$actionsChart"
            />
        </div>
    </div>

    @livewireChartsScripts
</x-layout>
