<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Movie DB</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css"
    />

    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>

    <style>
        .choices{
            max-width: 400px;
        }
    </style>

    @livewireStyles
</head>

<body class="h-full antialiased leading-none bg-gray-100">
    @include('impersonate')
    <div>

        @livewire('navbar')

        <div class="flex overflow-hidden bg-gray-100">
            <div class="flex flex-col flex-1 w-0 overflow-hidden">
                <div class="pt-1 pl-1 md:hidden sm:pl-3 sm:pt-3">
                    <button class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150" aria-label="Open sidebar">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <!-- The page content -->
                <main class="relative z-0 flex-1 overflow-y-auto focus:outline-none" tabindex="0">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    @livewireScripts
    @yield('scripts')
</body>

</html>
