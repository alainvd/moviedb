@extends('layouts.app')

@section('content')
    <ul>
        @foreach($filmFinancingPlans as $filmFinancingPlan)
            <li>
                {{ $filmFinancingPlan }}
            </li>
        @endforeach
    </ul>
@endsection