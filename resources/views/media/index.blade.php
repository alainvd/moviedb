<x-layout>

    <ul>
        @foreach($medium as $media)
        <li>
            {{$media->title}} [{{$media->grantable_type}}]<br />
        </li>
        @endforeach
    </ul>

    <div class="w-1/3 p-2">
        <livewire:chip-autocomplete />
    </div>

</x-layout>
