@extends('layouts.public')

@section('content')
    <!-- Search section -->
    <div class="px-4 mx-auto mt-8 bg-transparent xl:mt-16 search-section lg:px-16 xl:px-8 xl:w-3/4">
        <div>
            <h1 class="mb-8 text-4xl tracking-wide text-center">
                Welcome to the Creative Europe MEDIA Database
            </h1>
            <p class="my-4 text-lg tracking-wide">
                This platform supports the implementation of the Creative Europe programme of the European Union.
            </p>
            <p class="my-4 text-lg tracking-wide">
                It allows searching for films created and qualified in the framework of the calls for proposals and access dossiers with audiovisual works information created when preparing an application for funding.
            </p>
        </div>
        <div class="flex flex-col py-16 mt-8 lg:flex-row">
            <img class="order-2 w-1/2 mx-auto lg:order-1 2xl:w-1/3" src="{{ asset('images/welcome-1.png') }}" alt="Creative Europe MEDIA">
            <div class="self-center order-1 p-8 sm:px-24 lg:px-16 lg:order-2 xl:w-1/2">
                <div class="text-lg tracking-wide">
                    Do you want to find information on an existing film, including the status, the nationality, the grant awarded?
                </div>
                <div class="relative">
                    <form action="{{ route('search') }}" method="GET">
                        <input class="block w-full py-3 pl-4 pr-8 mt-8 mb-3 leading-tight text-gray-700 bg-white border-4 border-indigo-700 appearance-none focus:outline-none focus:bg-white" type="text" placeholder="Film title, ID or director" name="q">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                            <button type="submit" class="p-1 text-gray-500 focus:outline-none">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Links section  -->
    <div class="relative w-full bg-gray-200 link-section">
        <!-- Diagonal border -->
        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none" fill="currentColor">
            <polygon points="100 0 100 10 0 0" />
        </svg>

        <div class="flex flex-col py-16 xl:px-32 lg:flex-row">
            <div class="self-center px-32 mb-16 md:pr-0">
                <h5 class="text-lg font-light tracking-wide">
                    Do you have pending files related to the film or AV works information to be updated?
                </h5>
                <a class="block mt-2 text-lg font-bold text-indigo-700" href="{{ route('dossiers.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                    Go to my dossiers
                </a>
                <h5 class="mt-16 text-lg font-light tracking-wide">
                    Do you want to have more information on funding opportunities of Creative Europe or prepare an application for a funding support?
                </h5>
                <a class="block mt-2 text-lg font-bold text-indigo-700" href="https://ec.europa.eu/info/funding-tenders/opportunities/portal/screen/home" target="blank">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                    EU Funding and Tender Opportunities Portal
                </a>
            </div>
            <img class="w-1/2 mx-auto 2xl:w-1/3" src="{{ asset('images/videographer_graybg.png') }}" alt="Creative Europe Media">


            <div class="absolute w-5 h-5 bg-yellow-500 rounded-full"  style="left: 5%; top: 20%"></div>
            <div class="absolute w-3 h-3 bg-indigo-700 rounded-full" style="left: 7%; top: 24%"></div>

            <div class="absolute w-5 h-5 bg-yellow-500 rounded-full" style="left: 58%; top: 52%"></div>
            <div class="absolute w-3 h-3 bg-indigo-700 rounded-full" style="left: 57%; top: 59%"></div>

            <div class="absolute w-3 h-3 bg-yellow-500 rounded-full" style="top: 65%; right: 5%"></div>
        </div>
    </div>
@endsection
