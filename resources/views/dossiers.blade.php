<x-layout>

    <div class="md:flex">
        <div class="m-4 p-4 md:w-1/2">
            <div class="my-4">
                <h2 class="text-black text-4xl leading-10">Welcome to MediaDB</h2>
            </div>
            <div class="my-4">
                <span class="text-gray-700 font-sans leading-6 text-xl">The European Commission Media tool supporting
                    Media Programme implementation in Europe</span>
            </div>
            <div class="my-4 py-30">
                <div class="inline-block relative">
                    <select
                        class="block appearance-none w-full px-3 py-3 pr-8 border-2 border-indigo-700 text-sm text-indigo-700 font-bold"
                        name="call" id="call">
                        <option value="one">Select a call</option>
                        <option value="two">Two</option>
                        <option value="three">Three</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="my-4 py-3">
                <div class="inline-block relative">
                    <input type="text"
                        class="p-3 border-2 border-indigo-700 text-sm text-indigo-700 placeholder-indigo-700 font-bold"
                        placeholder="enter your project ID">
                    <button type="button"
                        class="p-3 border-2 border-indigo-700 text-sm text-white font-bold bg-indigo-700">
                        Create Technical Annex
                    </button>
                </div>
            </div>
        </div>
        <div class="m-4 p-4 md:w-1/2">
            <img src="/images/undraw_videographer.png" alt="Videographer">
        </div>
    </div>
    <div>
        <div class="m-4 p-4">
            <div class="my-4">
                <h2 class="text-black text-4xl leading-10">Your dossiers</h2>
            </div>
            <div class="inline-block">
                <span class="text-gray-700 font-sans leading-6 text-xl">here are your existing technical dossiers as
                    recorded in MediaDB.</span>
            </div>
            <div class="inline-block float-right text-indigo-700 font-semibold text-sm">
                <!-- <input class="m-2" type="checkbox" name="show" id="show">
                <label for="show">Show Closed Calls</label> -->
                @livewire('show-closed-calls')
            </div>
            <div class="mt-8 space-y-2 sm:space-y-4 clear-right">
                @foreach($dossiers as $dossier)
                    @livewire('dossier-item', ['dossier' => $dossier])
                @endforeach
            </div>
        </div>
    </div>

</x-layout>