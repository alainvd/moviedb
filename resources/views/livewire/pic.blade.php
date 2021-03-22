
    <div>

        <input type="text"  wire:model.debounce.500ms="company" class="border border-4 border-gray-400 rounded-2xl px-4 py-2 bg-gray-200">

        <div class="mt-4">
            @if($entities)
                <div class="text-2xl">Results:</div>
            <ul>
                @foreach($entities as $entity)
                    <li wire:key="{{$loop->index}}">
                       <span class="text-base"> {{$entity['legalName']}} ({{$entity['country']}}) </span> &bull; PIC: <span class="text-gray-700">{{$entity['pic']}}</span>
                    </li>
                @endforeach
            </ul>
                @endif
        </div>
    </div>

