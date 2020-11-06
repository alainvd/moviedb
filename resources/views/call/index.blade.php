@extends('layouts.app')

@section('content')
    <ul>
        @foreach($calls as $call)
            <li>
                {{$call}}
            </li>
        @endforeach
    </ul>

@endsection

