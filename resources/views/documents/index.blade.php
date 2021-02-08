@extends('layouts.app')

@section('content')
    <ul>
        @foreach($Documents as $Document)
            <li>
                {{ $Document }}
            </li>
        @endforeach
    </ul>
@endsection