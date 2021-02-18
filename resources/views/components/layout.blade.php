<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Movie DB</title>
    <meta content="width=device-width,initial-scale=1" name="viewport" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.scripts.alpine')
    @include('partials.scripts.choices')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
                    @if ($title)
                        <h1 class="mt-8 text-3xl font-light leading-tight">
                            {{ $title }}
                        </h1>
                    @endif
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <x-notification />

    <script src="{{ asset('js/app.js') }}" defer></script>
    @livewireScripts
    @yield('scripts')
</body>

</html>
