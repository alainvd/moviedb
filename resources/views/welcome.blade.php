<x-layout>

    <a href="{{route('homepage')}}">FromSEP Homepage</a><br />
    <a href="{{route('dossiers_test')}}">Public Homepage (Your dossiers test)</a><br />
    <a href="{{route('movies')}}">Movies</a><br />
    <a href="{{route('movie_detail', ['movie'=>1])}}">Movie detail</a><br />

</x-layout>
