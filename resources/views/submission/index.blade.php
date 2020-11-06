@extends('layouts.app')

@section('content')
    @foreach($submissions as $submission)
    <ul>
        <li>
            {{$submission}}
        <ol>
            <li>
                {{$submission->call()->get()}}
            </li>
        </ol>

        </li>
    </ul>


    @endforeach
@endsection

