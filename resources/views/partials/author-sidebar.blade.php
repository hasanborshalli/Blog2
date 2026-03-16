<aside class="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('author.dashboard') }}">Author Panel</a>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('author.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('author.dashboard') ? 'sidebar-link-active' : '' }}">Dashboard</a>
        <a href="{{ route('author.posts.index') }}"
            class="sidebar-link {{ request()->routeIs('author.posts.index') ? 'sidebar-link-active' : '' }}{{ request()->routeIs('author.posts.edit') ? 'sidebar-link-active' : '' }}">My
            Posts</a>
        <a href="{{ route('author.posts.create') }}"
            class="sidebar-link {{ request()->routeIs('author.posts.create') ? 'sidebar-link-active' : '' }}">Create
            Post</a>
        <a href="{{ route('author.profile.edit') }}"
            class="sidebar-link {{ request()->routeIs('author.profile.*') ? 'sidebar-link-active' : '' }}">Profile</a>
        <a href="{{ route('home') }}" class="sidebar-link">View Website</a>
    </nav>
</aside>