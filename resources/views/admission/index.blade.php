@extends('layouts.app')

@section('content')
    <ul>
        @foreach($admissions as $admission)
            <li>
                {{$admission}}
            </li>
        @endforeach
    </ul>

@endsection
