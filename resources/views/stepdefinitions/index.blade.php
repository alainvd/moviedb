@extends('layouts.app')

@section('content')
    ID - Action - Step ID - Position - Version - Step object
    <ul>
        @foreach($stepDefinitions as $stepDefinition)
            <li>
                {{$stepDefinition->id}} - {{$stepDefinition->action}} - {{$stepDefinition->step_id}} - {{$stepDefinition->position}} - {{$stepDefinition->version}} - {{$stepDefinition->step}}
            </li>
        @endforeach
    </ul>

@endsection
