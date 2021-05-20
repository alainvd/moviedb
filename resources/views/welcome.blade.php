@extends('layouts.public')

@section('content')
    <!-- Search section -->
    <div class="mt-8 xl:mt-16 bg-transparent search-section px-4 lg:px-16 xl:px-8 xl:w-3/4 mx-auto">
        <div>
            <h1 class="text-4xl tracking-wide text-center mb-8">
                Creative Europe MEDIA movie Database
            </h1>
            <h5 class="text-lg tracking-wide">
                The Creative Europe MEDIA database is an online platform to enable the collection, linking and sharing of information on films, TV movies, series, video games or shorts included in applications for development, production or distribution support of MEDIA strand of Creative Europe.
            </h5>
        </div>
        <div class="flex flex-col lg:flex-row mt-8 py-16">
            <img class="order-2 lg:order-1 w-1/2 2xl:w-1/3 mx-auto" src="{{ asset('images/welcome-1.png') }}" alt="Creative Europe MEDIA">
            <div class="p-8 sm:px-24 lg:px-16 order-1 lg:order-2 xl:w-1/2 self-center">
                <div class="tracking-wide text-lg">
                    Do you want to find information on an existing film, including the status, the nationality, the grant awarded?
                </div>
                <div class="relative">
                    <form action="{{ route('search') }}" method="GET">
                        <input class="mt-8 appearance-none block w-full bg-white text-gray-700 border-4 border-indigo-700 py-3 pl-4 pr-8 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="Film title, ID or director" name="q">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                            <button type="submit" class="p-1 focus:outline-none text-gray-500">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Links section  -->
    <div class="w-full bg-gray-200 link-section relative">
        <!-- Diagonal border -->
        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none" fill="currentColor">
            <polygon points="100 0 100 10 0 0" />
        </svg>

        <div class="py-16 xl:px-32 flex flex-col lg:flex-row">
            <div class="px-32 mb-16 md:pr-0 self-center">
                <h5 class="text-lg tracking-wide font-light">
                    Do you have pending files related to the film or AV works information to be updated?
                </h5>
                <a class="block mt-2 text-indigo-700 text-lg font-bold" href="{{ route('dossiers.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                    Go to my dossiers
                </a>
                <h5 class="mt-16 text-lg tracking-wide font-light">
                    Do you want to have more information on funding opportunities of Creative Europe or prepare an application for a funding support?
                </h5>
                <a class="block mt-2 text-indigo-700 text-lg font-bold" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                    EU Funding and Tender Opportunities Portal
                </a>
            </div>
            <img class="w-1/2 2xl:w-1/3 mx-auto" src="{{ asset('images/videographer_graybg.png') }}" alt="Creative Europe Media">


            <div class="absolute rounded-full h-5 w-5 bg-yellow-500"  style="left: 5%; top: 20%"></div>
            <div class="absolute rounded-full h-3 w-3 bg-indigo-700" style="left: 7%; top: 24%"></div>

            <div class="absolute rounded-full h-5 w-5 bg-yellow-500" style="left: 58%; top: 52%"></div>
            <div class="absolute rounded-full h-3 w-3 bg-indigo-700" style="left: 57%; top: 59%"></div>

            <div class="absolute rounded-full h-3 w-3 bg-yellow-500" style="top: 65%; right: 5%"></div>
        </div>
    </div>
@endsection
