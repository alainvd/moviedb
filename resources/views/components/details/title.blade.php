<div class="flex justify-between">
    <h2 class="text-2xl leading-7 text-gray-900">
        DIST {{$movie->year_of_copyright }}/{{ $movie->id }}/
        - {{ $movie->original_title }}
        <span id="title-info" class="cursor-pointer">
            <svg class="inline-block w-8 h-8 -mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
        </span>
    </h2>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            window.tippy('#title-info', {
                content: 'In order to be eligible, the recent work must fulfil minimum conditions in terms of having been commercially distributed. Please consult the Call’s eligibility criteria for the conditions that apply, and complete the table. If a distributor released or broadcasted the work in more than one country, add a line per country. The date to be provided is the one of the actual official release in cinema or the broadcast date.',
                placement: 'bottom',
            });
        });
    </script>

    @if($fiche->updated_at)
    <div class="mt-3 text-xs tracking-tight text-gray-600 align-baseline">
        Modified on {{ $fiche->updated_at->format('d F Y') }} by John Smith
    </div>
    @endif
</div>
