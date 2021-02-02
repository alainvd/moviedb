<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>MovieDB - Landing page</title>
    <meta content="width=device-width,initial-scale=1" name="viewport"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
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

<body>

@include('impersonate')
@include('partials.landing.header')
<main class="w-full relative z-0 flex-1 px-24 py-6 overflow-y-auto focus:outline-none" tabindex="0" style="background: url('{{ asset('images/dossier/dots-side-1.png') }}') right 250px no-repeat">
    {{ $slot }}
</main>


@include('partials.landing.footer')

<script src="{{ asset('js/app.js') }}" defer></script>
@livewireScripts
@yield('scripts')
</body>

</html>
