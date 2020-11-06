@extends('layouts.app')

@section('content')
    <ul>
        @foreach($medium as $media)
            <li>
                {{$media->title}} [{{$media->grantable_type}}]<br/>{{$media->grantable->whoami()}}
            </li>
        @endforeach
    </ul>

@endsection
