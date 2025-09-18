<div class="sidebar d-flex flex-column p-3" style="width:240px; min-height:100vh; background:#212529;">
    <h4 class="text-white mb-4">🚗 GPS Admin</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active text-white bg-primary' : 'text-secondary' }}">
                📊 Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}"
                class="nav-link {{ request()->routeIs('admin.users.*') ? 'active text-white bg-primary' : 'text-secondary' }}">
                👤 Master Data User
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.user.history', 1) }}"
                class="nav-link {{ request()->routeIs('admin.user.history') ? 'active text-white bg-primary' : 'text-secondary' }}">
                📍 History Lokasi
            </a>
        </li>
    </ul>
    <hr class="text-secondary">
    <form action="{{ route('admin.logout') }}" method="POST" class="mt-auto">
        @csrf
        <button class="btn btn-danger w-100">Logout</button>
    </form>
</div>