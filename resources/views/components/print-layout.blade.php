<html>

<head>
    <link href="{{ asset('css/download.css') }}" rel="stylesheet">
</head>

<body>

    <main>
        @if (isset($title))
            <h1 class="mt-8 text-3xl font-light leading-tight">
                {{ $title }}
            </h1>
        @endif
        {{ $slot }}
    </main>

</body>

</html>
