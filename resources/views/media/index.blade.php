<x-landing-layout>

    <ul>
        @foreach($medium as $media)
        <li>
            {{$media->title}} [{{$media->grantable_type}}]<br />
        </li>
        @endforeach
    </ul>

</x-landing-layout>
