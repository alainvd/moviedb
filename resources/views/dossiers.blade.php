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
                <input class="m-2" type="checkbox" name="show" id="show">
                <label for="show">Show Closed Calls</label>
            </div>
            <div class="mt-8 space-y-2 sm:space-y-4 clear-right">
                @foreach($dossiers as $dossier)
                <div class="flex p-5 sm:rounded-lg shadow-lg text-xs bg-white">
                    <div class="inline-block flex-1">
                        {{ $dossier->project }}
                        @if ($dossier->shield)
                        <svg class="w-4 h-4 inline-block ml-1 -mt-1 text-white text-orange-600"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z"
                                clip-rule="evenodd" />
                        </svg>
                        @endif
                    </div>
                    <div class="inline-block flex-1">{{ $dossier->call }}</div>
                    <div class="inline-block flex-1 text-right text-indigo-700">
                        @if ($dossier->edit)
                        <a class="mr-4" href="#">
                            <svg class="w-3 h-3 inline-block mr-1 -mt-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Edit
                        </a>
                        @endif
                        <a href="#">
                            <svg class="w-4 h-4 inline-block mr-1 -mt-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</x-layout>