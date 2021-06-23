@extends('layouts.app')

@section('content')
    <ul>
        @foreach($admissionsTables as $admissions_table)
            <li>
                {{$admissions_table}}
            </li>
        @endforeach
    </ul>

@endsection
