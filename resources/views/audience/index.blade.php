@extends('layouts.app')

@section('content')
    <ul>
        @foreach($audiences as $audience)
            <li>
                {{$audience}}
            </li>
        @endforeach
    </ul>

@endsection
