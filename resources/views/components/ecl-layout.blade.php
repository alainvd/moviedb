<html lang="en" class="no-js">

<head>
    <meta charset="utf-8"/>
    <title>MovieDB - Landing page</title>
    <meta content="width=device-width,initial-scale=1" name="viewport"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://europa.eu/webtools/load.js" type="text/javascript"></script>
    <script>
        var cl = document.querySelector('html').classList;
        cl.remove('no-js');
        cl.add('has-js');
      </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>

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

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdn1.fpfis.tech.ec.europa.eu/ecl/v2.35.0/ec-preset-website/styles/ecl-ec-preset-website.css"
      integrity="sha256-/CTmTGBc548nFtg/sNpm1A5seXw2xdc3scSRJYVZa04= sha384-UueUbBb7zPQCYd5v3xMpkt1YOWMM41e3RXGfFEHLh0x9uKFkikkr5PLTRVDjeoSV sha512-rfQPhpoIeEeptRw/mxdY8i4FHOVocZHE5hwjPG77lCoxhi1bTKc7WnNEE3m0IH5lzlPPCST1FjZdF1k2tfktWg=="
      crossorigin="anonymous"
      media="screen"
    />
    <link
      rel="stylesheet"
      href="https://cdn1.fpfis.tech.ec.europa.eu/ecl/v2.35.0/ec-preset-website/styles/ecl-ec-preset-website-print.css"
      integrity="sha256-dPeH353ec7uW4YEuHclM+Yj54fIozspmT4GAH5nz4Cs= sha384-aWGCbkTKi/FW307CLKzimiPUBRHBHBzXkFb6BFoS7KN5S3XewjAHkTrDkDBsEU4M sha512-CcVYAXLxA/ZBP13G4j6XEWfNQx5ULQiqKheJYEyLO2aShbuB61WbuQHcV/dP+rSAxj9nn6h/rTaVgy+xOQ+/oA=="
      crossorigin="anonymous"
      media="print"
    />
    @livewireStyles
</head>

<body>

<div id="ec-globan"></div>
@include('partials.ecl.site-header')
@include('partials.ecl.page-header')

<main class="relative z-0 flex-1 px-1 py-6 overflow-y-auto focus:outline-none" tabindex="0">
    {{ $slot }}
</main>


@include('partials.ecl.footer')

<script
    src="https://cdn1.fpfis.tech.ec.europa.eu/ecl/v2.35.0/ec-preset-website/scripts/ecl-ec-preset-website.js"
    integrity="sha256-qO+7dfESMDIKar3qGGBZTR9IcrGf7QO6tZl1sQ4D/78= sha384-qCJ7au4/Q8n5jFHtqRvgi3M6iyE6RVAmn4WCzHW9GYY/hJ2sQ0yqVfasUe9iuejS sha512-7QPMbmO3+iluq3jlo4w+rA38jOoIRa/DNr8VTVWOShnQtAjQDtaQQ9/vOjywtJvDT+GuXPQj4gugQffNMDfDhw=="
    crossorigin="anonymous"
></script>
<script>
    ECL.autoInit();
</script>
<script src="{{ asset('js/app.js') }}" defer></script>
@livewireScripts
@yield('scripts')
<script>
window.onload = (event) => {
    $wt.render("ec-globan", {
        utility: "globan",
        lang: "en",
        theme: "light",
        logo: true,
        link: true,
        mode: false,
        zindex : 40
    });
};
</script>
</body>

</html>
