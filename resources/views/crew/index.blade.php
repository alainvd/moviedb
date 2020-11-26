@extends('layouts.app')

@section('content')
    <ul>
        @foreach($crews as $crew)
            <li>
                {{$crew}}
            </li>
        @endforeach
    </ul>

@endsection
