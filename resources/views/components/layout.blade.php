<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Creative Europe MEDIA Database</title>
    <meta content="width=device-width,initial-scale=1" name="viewport" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.scripts.webtools')
    @include('partials.scripts.alpine')
    @include('partials.scripts.functions')
    @include('partials.scripts.choices')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body class="h-full antialiased leading-none bg-gray-100">
    @include('partials.scripts.impersonate')
    <div>

        @livewire('navbar')

        <div class="flex pb-16 overflow-hidden bg-gray-100">
            <div class="flex flex-col flex-1 w-0 overflow-hidden">
                <!-- The page content -->
                <main class="relative z-0 flex-1 overflow-y-auto focus:outline-none" tabindex="0">
                    @if (isset($title))
                        <h1 class="px-4 mt-8 text-3xl font-light leading-tight">
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
