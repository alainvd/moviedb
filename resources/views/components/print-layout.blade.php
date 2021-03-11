<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Creative Europe MEDIA database</title>
    <meta content="width=device-width,initial-scale=1" name="viewport" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/download.css') }}" rel="stylesheet">
</head>

<body class="h-full antialiased leading-none bg-gray-100">
    <div>
        <div class="flex bg-gray-100">
            <div class="flex flex-col flex-1">
                <!-- The page content -->
                <main class="relative z-0 flex-1 overflow-y-auto focus:outline-none" tabindex="0">
                    @if (isset($title))
                        <h1 class="mt-8 text-3xl font-light leading-tight">
                            {{ $title }}
                        </h1>
                    @endif
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>

</html>
