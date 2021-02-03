<html lang="en" class="no-js">

<head>
    <meta charset="utf-8"/>
    <title>MovieDB - Landing page</title>
    <meta content="width=device-width,initial-scale=1" name="viewport"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.scripts.webtools')
    @include('partials.scripts.alpine')
    @include('partials.scripts.choices')
    @include('partials.scripts.ecl')
    @include('partials.scripts.cck')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body style="{{ $style ?? '' }}">

@include('impersonate')
<div id="ec-globan"></div>
@include('partials.ecl.site-header')
@include('partials.ecl.page-header', ['title' => $title ?? null, 'crumbs' => $crumbs ?? []])

<main class="relative z-0 flex-1 px-1 py-2 overflow-y-auto focus:outline-none" tabindex="0">
    {{ $slot }}
</main>

@include('partials.ecl.footer')

<script src="{{ asset('js/app.js') }}" defer></script>
@include('partials.scripts.ecl-footer')
@include('partials.scripts.ec-global')
@livewireScripts
@yield('scripts')
</body>

</html>
