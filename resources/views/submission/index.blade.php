@extends('layouts.app')

@section('content')
    @foreach($submissions as $submission)
        {{$submission}}<br/>
        {{$submission->call()->get()}}<br/>
    @endforeach
@endsection

