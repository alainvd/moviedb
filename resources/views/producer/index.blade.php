@extends('layouts.app')

@section('content')
    <ul>
        @foreach($producers as $producer)
            <li>
                {{ $producer }}
            </li>
        @endforeach
    </ul>
@endsection
