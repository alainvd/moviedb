<html lang="en" class="no-js">

<head>
    <meta charset="utf-8"/>
    <title>Creative Europe MEDIA Database</title>
    <meta content="width=device-width,initial-scale=1" name="viewport"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.scripts.webtools')
    @include('partials.scripts.alpine')
    @include('partials.scripts.functions')
    @include('partials.scripts.choices')
    @include('partials.scripts.ecl')
    @include('partials.scripts.cck')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body class="{{ $class ?? '' }}">

@include('partials.scripts.impersonate')
<div id="ec-globan" class="print:hidden"></div>
@include('partials.ecl.site-header')
@include('partials.ecl.page-header', ['title' => $title ?? null, 'crumbs' => $crumbs ?? []])

<main class="relative flex-1 px-1 py-2 overflow-y-auto z-51 focus:outline-none" tabindex="0">
    {{ $slot }}
</main>

<x-notification />

@include('partials.ecl.footer')

<script src="{{ asset('js/app.js') }}" defer></script>
@include('partials.scripts.ecl-footer')
@include('partials.scripts.ec-globan')
@livewireScripts
@yield('scripts')
</body>

</html>
