<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title') –Super Freighters</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('app/images/apple-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('app/images/favicon.png')}}" />
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
