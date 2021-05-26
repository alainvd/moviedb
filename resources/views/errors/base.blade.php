<head>
    <meta charset="utf-8" />
    <title>Creative Europe MEDIA database</title>
    <meta content="width=device-width,initial-scale=1" name="viewport" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @include('partials.scripts.ecl')
</head>

<body class="error-page">
    @include('partials.landing.header')

    <main class="my-16 md:mt-32 flex flex-col md:flex-row">
        @yield('content')
    </main>

    @include('partials.ecl.footer')
</body>
