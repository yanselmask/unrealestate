<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://finder.createx.studio/vendor/lightgallery/css/lightgallery-bundle.min.css">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />

    {{ $css_vendor ?? null }}

    @stack('css_vendor')

    <!-- Vendor Styles-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
    <link rel="stylesheet" media="screen"
        href="https://finder.createx.studio/vendor/simplebar/dist/simplebar.min.css" />
    <link rel="stylesheet" media="screen"
        href="https://finder.createx.studio/vendor/lightgallery/css/lightgallery-bundle.min.css" />
    <link rel="stylesheet" media="screen"
        href="https://finder.createx.studio/vendor/tiny-slider/dist/tiny-slider.css" />
    <link rel="stylesheet" media="screen"
        href="https://finder.createx.studio/vendor/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://finder.createx.studio/vendor/nouislider/dist/nouislider.min.css">
    <link rel="stylesheet" media="screen" href="https://finder.createx.studio/css/theme.min.css">
    {{-- @vite(['themes/Default/sass/app.scss'], 'Default') --}}

</head>
<!-- Body-->

<body>
    <!-- Page loading spinner-->
    @include('partials.loading_spinner')
    <main class="page-wrapper">
        <!-- Modal-->
        @if (!$outHeader)
            <!-- Navbar-->
            @include('partials.header')
        @endif
        <!-- Page content-->
        {{ $slot }}
    </main>
    <!-- Footer-->
    @include('partials.footer_barrel')
</body>

</html>
