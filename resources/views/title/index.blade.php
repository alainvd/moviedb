@extends('layouts.app')

@section('content')
    <ul>
        @foreach($titles as $title)
            <li>
                {{$title}}
            </li>
        @endforeach
    </ul>

@endsection
