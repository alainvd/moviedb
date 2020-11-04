@extends('layouts.app')

@section('content')
    @foreach($calls as $call)
        {{$call}}<br/>
    @endforeach
@endsection

