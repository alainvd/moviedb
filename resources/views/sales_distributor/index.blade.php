@extends('layouts.app')

@section('content')
    <ul>
        @foreach($salesDistributors as $salesDistributor)
            <li>
                {{ $salesDistributors }}
            </li>
        @endforeach
    </ul>
@endsection
