@extends('layouts.app')

@section('content')
    <ul>
        @foreach($steps as $step)
            <li>
                {{$step->id}} - {{$step->category}} - {{$step->description}}
                <ol>
                    @foreach($step->checklists as $checklist)
                        <li>
                            {{$checklist}}
                        </li>
                    @endforeach

                </ol>

            </li>
        @endforeach
    </ul>

@endsection
