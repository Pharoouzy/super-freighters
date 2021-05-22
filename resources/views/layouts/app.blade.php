<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Material Bootstrap Wizard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    @include('partials.app._css')
</head>
<body>
    <div class="image-container set-full-height" style="background-image: url({{asset('app/images/bg.jpeg')}})">
        <!--   Creative Tim Branding   -->
        <a href="http://creative-tim.com">
            <div class="logo-container">
                <div class="brand">
                    Super Freighters
                </div>
            </div>
        </a>

        <!--   Big container   -->
        <div class="container">
            @yield('content')
        </div> <!--  big container -->

        <div class="footer">
            <div class="container text-center">
                &copy; 2021 <a href="#">Super Freighters</a>.
            </div>
        </div>
    </div>
    @include('partials.app._js')
</body>
</html>
