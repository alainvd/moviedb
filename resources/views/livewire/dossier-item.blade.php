@if($show_closed || !$dossier['closed'])
<div class="flex p-5 sm:rounded-lg shadow-lg text-xs bg-white">
    <div class="inline-block flex-1">
        {{ $dossier['project'] }}
        @if ($dossier['shield'])
        <svg class="w-4 h-4 inline-block ml-1 -mt-1 text-white text-orange-600"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z"
                clip-rule="evenodd" />
        </svg>
        @endif
    </div>
    <div class="inline-block flex-1">{{ $dossier['call'] }}</div>
    <div class="inline-block flex-1 text-right text-indigo-700">
        @if ($dossier['edit'])
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
@else
<div></div>
@endif