<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') – MMAKYEWA</title>
    <meta name="description" content="@yield('description', 'Everything you need.')">
    <meta name="keywords" content="makup,website">
    <meta name="author" content="Pharoouzy">

    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@mmakyewa">
    <meta property="twitter:creator" content="@mmakyewa">

    <meta name="og:title" content="MMAKYEWA | Everything You Need" />
    <meta name="og:type" content="website" />
    <meta name="og:url" content="https://mmakyewa.com" />
    <meta name="og:image" content="{{ asset('app/images/logo-w.png') }}" />
    <meta name="og:site_name" content="{{ config('settings.site_name') }}" />
    <meta name="og:description" content="@yield('description', 'For best price, best quality makeup and accurate time of delivery choose MMAKYEWA.COM, we are out to giving you the best.')" />

    <meta name="og:email" content="{{ config('settings.default_email_address') }}" />
    <meta name="og:phone_number" content="{{ config('settings.default_phone_number') }}" />
    <meta name="og:fax_number" content="{{ config('settings.default_phone_number') }}" />

    <meta name="og:street-address" content="{{ config('settings.default_address') }}" />
    <meta name="og:locality" content="Nigeria" />
    <meta name="og:region" content="Lagos State" />
    <meta name="og:postal-code" content="101245" />
    <meta name="og:country-name" content="Nigeria" />
    <meta name="robots" content="noindex, nofollow">
    <meta name="msapplication-tap-highlight" content="no">
    <!-- Fav Icon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/images/ico/apple-icon-120.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/ico/favicon-32.png') }}">
    <meta name="theme-color" content="#FFFFFF">

    @include('partials.admin._css')
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    @include('partials.admin._navbar')
    @include('partials.admin._sidebar')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            @yield('content')
        </div>
    </div>
    @include('partials.admin._footer')
    @include('partials.admin._js')
</body>
</html>
