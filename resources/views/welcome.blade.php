<x-layout>

    <a href="{{route('homepage')}}">FromSEP Homepage</a><br />
    <a href="{{route('dossiers_test')}}">Public Homepage (Your dossiers test)</a><br />
    <a href="{{route('movies')}}">Movies</a><br />
    <br />
    EACEA:<br />
    <a href="{{route('movie_create_eacea')}}">Create new</a><br />
    <a href="{{route('movie_detail_eacea', ['movie'=>1])}}">Movie detail</a><br />
    <br />
    Applicant:<br />
    <a href="{{route('movie_create_applicant')}}">Create new</a><br />
    <a href="{{route('movie_detail_applicant', ['movie'=>1])}}">Movie detail</a><br />

</x-layout>
