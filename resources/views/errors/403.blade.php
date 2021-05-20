@extends('errors.base')

@section('content')
    <div class="md:w-1/2 px-8 text-center md:text-left">
        <h2 class="text-4xl font-bold tracking-wide">
            OOPS!
        </h2>
        <h3 class="text-3xl font-normal tracking-normal">
            Something went wrong
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
