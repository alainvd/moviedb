<div class="w-full grid grid-cols-5 gap-4 text-white overflow-hidden">
    @foreach ($dials as $dial)
        <div class="px-8 py-4 col-span-1 bg-{{ $dial['color'] }}-500 relative">
            <h1 class="text-5xl font-thin">{{ $dial['data'] }} <span class="text-sm font-normal">dossiers</span></h1>
            <p class="text-md font-normal mt-2">{{ $dial['label'] }}</p>
            <div class="circle rounded-full h-32 w-32 bg-white bg-opacity-25  absolute" style="right: -10%; bottom: -50%"></div>
            <div class="circle rounded-full h-24 w-24 bg-white bg-opacity-25  absolute" style="right: -10%; top: -20%"></div>
        </div>
    @endforeach
</div>
