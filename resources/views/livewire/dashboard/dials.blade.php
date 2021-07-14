<div class="grid w-full grid-cols-5 gap-4 overflow-hidden text-white">
    @foreach ($dials as $dial)
        <div class="px-8 py-4 col-span-1 bg-{{ $dial['color'] }}-500 relative">
            <h1 class="text-5xl font-extralight">{{ $dial['data'] }} <span class="text-sm font-normal">dossiers</span></h1>
            <p class="mt-2 font-normal text-md">{{ $dial['label'] }}</p>
            <div class="absolute w-32 h-32 bg-white bg-opacity-25 rounded-full circle" style="right: -10%; bottom: -50%"></div>
            <div class="absolute w-24 h-24 bg-white bg-opacity-25 rounded-full circle" style="right: -10%; top: -20%"></div>
        </div>
    @endforeach
</div>
