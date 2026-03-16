<nav class="navbar">
    <div class="container navbar-inner">
        <a href="{{ route('home') }}" class="navbar-brand">
            @if(setting('site_logo'))
            <img src="{{ asset('storage/' . setting('site_logo')) }}" alt="{{ setting('site_name', 'Community Blog') }}"
                style="height: 42px; width: auto; object-fit: contain;">
            @else
            {{ setting('site_name', 'Community Blog') }}
            @endif
        </a>

        <div class="navbar-links">
            <a href="{{ route('home') }}" class="navbar-link">Home</a>
            <a href="{{ route('contact') }}" class="navbar-link">Contact</a>

            <form action="{{ route('search') }}" method="GET" class="navbar-search-form">
                <input type="text" name="q" class="navbar-search-input" placeholder="Search articles..."
                    value="{{ request('q') }}">
            </form>

            @guest
            <a href="{{ route('login') }}" class="navbar-link">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
            @endguest

            @auth
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="navbar-link">Admin Panel</a>
            @else
            <a href="{{ route('author.dashboard') }}" class="navbar-link">Dashboard</a>
            @endif

            <form action="{{ route('logout') }}" method="POST" class="inline-form">
                @csrf
                <button type="submit" class="btn btn-danger-outline">Logout</button>
            </form>
            @endauth
        </div>
    </div>
</nav>