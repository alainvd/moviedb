<head>
    <meta charset="utf-8" />
    <title>Creative Europe MEDIA database</title>
    <meta content="width=device-width,initial-scale=1" name="viewport" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @include('partials.scripts.ecl')
    @livewireStyles
</head>

<body class="public-page">
    @include('partials.landing.header')

    <main class="w-full pt-16">
        {{ $slot ?? null }}
        @yield('content')
    </main>

    @include('partials.ecl.footer')

    @livewireScripts
    @yield('scripts')
</body>
