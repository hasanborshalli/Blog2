<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', setting('seo_meta_title', setting('site_name', 'Community Blog')))</title>
    <meta name="description"
        content="@yield('meta_description', setting('seo_meta_description', 'A modern multi-author blog platform.'))">

    @if(setting('site_favicon'))
    <link rel="icon" href="{{ asset('storage/' . setting('site_favicon')) }}">
    @endif

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @stack('styles')
</head>

<body class="site-body">
    @include('partials.web-navbar')

    <main class="site-main">
        <div class="container">
            @include('partials.flash')
            @yield('content')
        </div>
    </main>

    @include('partials.web-footer')

    @stack('scripts')
</body>

</html>