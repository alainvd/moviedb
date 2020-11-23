@extends('layouts.app')

@section('content')
    <ul>
        @foreach($persons as $person)
            <li>
                {{$person}}
            </li>
        @endforeach
    </ul>

@endsection
