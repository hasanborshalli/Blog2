<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Author Dashboard')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @stack('styles')
</head>
<body class="dashboard-body">
    <div class="dashboard-shell">
        @include('partials.author-sidebar')

        <div class="dashboard-content-area">
            <header class="dashboard-topbar">
                <div>
                    <h1 class="dashboard-page-title">@yield('page_title', 'Dashboard')</h1>
                    <p class="dashboard-page-subtitle">@yield('page_subtitle', 'Welcome back')</p>
                </div>

                <div class="dashboard-topbar-actions">
                    <span class="dashboard-user-badge">
                        {{ auth()->user()->name }}
                    </span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger-outline">Logout</button>
                    </form>
                </div>
            </header>

            <main class="dashboard-main">
                @include('partials.flash')
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>