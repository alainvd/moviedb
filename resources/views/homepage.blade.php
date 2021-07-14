<x-ecl-layout>
    <div class="md:flex">
        <div class="p-4 my-4 md:w-1/2 sm:px-8 md:pl-16 md:pr-4 lg:pl-24 md:flex md:flex-col md:justify-center">
            <form id="create-dossier-form" action="{{route('dossiers.create')}}" method="get">
                @csrf
                {{ method_field('PATCH') }}
                <div>
                    <h2 class="text-4xl leading-10 text-black">Welcome to MediaDB</h2>
                </div>
                <div class="my-4 mb-8">
                    <span class="font-sans text-xl leading-6 text-gray-700">The European Commission Media tool supporting
                        Media Programme implementation in Europe</span>
                </div>
                <div>
                    <div class="relative inline-block">
                        <select class="block w-64 px-3 py-3 pr-8 text-sm font-bold text-indigo-700 bg-white border-2 border-indigo-700 appearance-none" name="call_id" id="call_id" required>
                            <option value="">Select a call</option>
                            @foreach ($calls as $call)
                            <option value="{{$call->name}}">
                                {{$call->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-2">
                    <input type="text" class="w-64 p-3 text-sm font-bold text-indigo-700 placeholder-indigo-700 border-2 border-indigo-700" name="PIC" placeholder="Enter PIC number">
                </div>
                <div class="mt-2">
                    <div class="relative inline-block">
                        <input type="text" name="draft_proposal_id" class="w-64 p-3 text-sm font-bold text-indigo-700 placeholder-indigo-700 border-2 border-indigo-700" placeholder="enter your project ID" required>
                        <button id="create-dossier" type="submit" class="p-3 mt-2 text-sm font-bold text-white bg-indigo-700 border-2 border-indigo-700">
                            Create media dossier
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="flex items-center p-4 my-4 md:w-1/2 md:p-0">
            <img src="/images/undraw_videographer.png" alt="Videographer">
        </div>
    </div>
</x-ecl-layout>
