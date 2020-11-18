@extends('layouts.app')

@section('content')
    <ul>
        @foreach($dossiers as $dossier)
            <li>
                {{$dossier}}
                <ol>
                    @foreach($dossier->checklists as $checklists)
                        {{$checklists}}
                    @endforeach
                </ol>
            </li>
        @endforeach
    </ul>

@endsection
