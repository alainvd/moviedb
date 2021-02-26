<x-landing-layout>

    <a href="{{route('homepage')}}">FromSEP Homepage</a><br />
    <a href="{{route('dossiers-public')}}">Public Homepage (Your dossiers test)</a><br />
    <a href="{{ url('browse/movies') }}">Movies Table</a><br />
    <a href="{{ url('dossiers-datatables') }}">Dossiers Table</a><br />
    <br />
    <a href="{{ url('document-download') }}">Table edit samples</a><br />
    <br />
    <a href="{{route('test_index')}}">Links to test pages</a><br />
    <br />
    <div class="mb-64"></div>
</x-landing-layout>
