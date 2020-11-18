@extends('layouts.app')

@section('content')
    - Checklist <br/>
    @foreach($checklists as $key =>$checklist)

        -- Dossier ID: {{$key}}<br/>
        @foreach($checklist as $key => $dossier)

            --- Media ID: {{$key}}<br/>
            @foreach($dossier as $line)
                 --- {{$line->dossier->project_ref_id}} - {{$line->position}} - {{$line->step->category}} - {{$line->step->description}} - {{$line->status}}<br/>
            @endforeach
            <br/>
        @endforeach
        <br/>
    @endforeach


@endsection
