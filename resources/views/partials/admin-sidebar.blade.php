<aside class="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.users.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'sidebar-link-active' : '' }}">
            Users
        </a>
        <a href="{{ route('admin.posts.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.posts.*') ? 'sidebar-link-active' : '' }}">Posts</a>
        <a href="{{ route('admin.categories.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'sidebar-link-active' : '' }}">Categories</a>
        <a href="{{ route('admin.tags.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.tags.*') ? 'sidebar-link-active' : '' }}">Tags</a>
        <a href="{{ route('admin.comments.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.comments.*') ? 'sidebar-link-active' : '' }}">Comments</a>
        <a href="{{ route('admin.messages.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'sidebar-link-active' : '' }}">Messages</a>
        <a href="{{ route('admin.settings.edit') }}"
            class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'sidebar-link-active' : '' }}">Settings</a>
        <a href="{{ route('home') }}" class="sidebar-link">View Website</a>
    </nav>
</aside>