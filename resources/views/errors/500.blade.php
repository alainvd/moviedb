@extends('errors.base')

@section('content')
    <div class="md:w-1/2 px-8 text-center md:text-left">
        <h2 class="text-4xl font-bold tracking-wide">
            Something went wrong!
        </h2>
        <h3 class="my-4 text-3xl font-normal tracking-normal">
            Please try again later!
            <br><br>
            If the problem persists, please write to us at:
            <br>
            <a class="text-indigo-700 hover:text-indigo-500" href="mailto: EACEA-MEDIA-DB@ec.europa.eu">EACEA-MEDIA-DB@ec.europa.eu</a>
        </h3>
        <x-anchors.primary
            class="mt-4"
            :url="url('/')">
            Go to homepage
        </x-anchors.primary>
    </div>
    <div class="md:w-1/2 flex items-center">
        <img src="/images/undraw_videographer.png" alt="Videographer">
    </div>
@endsection
