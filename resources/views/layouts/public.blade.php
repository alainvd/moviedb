<head>
    <meta charset="utf-8" />
    <title>Creative Europe MEDIA Database</title>
    <meta content="width=device-width,initial-scale=1" name="viewport" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @include('partials.scripts.webtools')
    @include('partials.scripts.functions')
    @include('partials.scripts.ecl')
    @include('partials.scripts.cck')
    @livewireStyles
</head>

<body class="public-page">
    <div id="ec-globan" class="print:hidden"></div>

    @include('partials.landing.header')

    <main class="w-full pt-16">
        {{ $slot ?? null }}
        @yield('content')
    </main>

    @include('partials.ecl.footer')
    @include('partials.scripts.ec-globan')

    @livewireScripts
    @yield('scripts')
</body>
