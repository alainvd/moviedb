<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>MovieDB - Landing page</title>
    <meta content="width=device-width,initial-scale=1" name="viewport" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body>

    @include('partials.landing.header')

    {{ $slot }}

    @include('partials.landing.footer')

    @livewireScripts
</body>

</html>
