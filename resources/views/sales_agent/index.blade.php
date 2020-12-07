@extends('layouts.app')

@section('content')
    <ul>
        @foreach($salesAgents as $salesAgent)
            <li>
                {{ $salesAgent }}
            </li>
        @endforeach
    </ul>
@endsection
