<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPS Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    @yield('head')
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        #sidebar {
            width: 240px;
            background: #f8f9fa;
            transition: margin-left 0.3s;
            display: flex;
            flex-direction: column;
        }

        #sidebar.collapsed {
            margin-left: -240px;
        }

        #content {
            flex: 1;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s;
            overflow: hidden;
        }

        #map {
            width: 100%;
            height: 70vh;
        }

        footer {
            background: #f8f9fa;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="main">
            <!-- Sidebar -->
            <div id="sidebar" class="d-flex flex-column p-3 text-white">
                <div class="text-center mb-3">
                    <img src="{{ asset('images/logo_pln.png') }}" alt="PLN Logo" style="max-width:120px; height:auto;">
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active text-white bg-primary' : 'text-secondary' }}">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active text-white bg-primary' : 'text-secondary' }}">
                            <i class="bi bi-person"></i> User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.cluster.index') }}"
                            class="nav-link {{ request()->routeIs('admin.cluster.*') ? 'active text-white bg-primary' : 'text-secondary' }}">
                            <i class="bi bi-diagram-3"></i> Cluster
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.uid.index') }}"
                            class="nav-link {{ request()->routeIs('admin.uid.*') ? 'active text-white bg-primary' : 'text-secondary' }}">
                            <i class="bi bi-hdd-network"></i> UID
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.provinsi.index') }}"
                            class="nav-link {{ request()->routeIs('admin.provinsi.*') ? 'active text-white bg-primary' : 'text-secondary' }}">
                            <i class="bi bi-geo-alt"></i> Provinsi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ulp.index') }}"
                            class="nav-link {{ request()->routeIs('admin.ulp.*') ? 'active text-white bg-primary' : 'text-secondary' }}">
                            <i class="bi bi-building"></i> ULP
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.user.history', 1) }}" class="nav-link {{ request()->routeIs('admin.user.history') ? 'active text-white bg-primary' : 'text-secondary' }}">
                            <i class="bi bi-clock-history"></i> History Lokasi
                        </a>
                    </li>
                </ul>
                <hr class="text-secondary">
                @if(Auth::guard('admin')->check())
                <form action="{{ route('admin.logout') }}" method="POST" class="mt-auto">
                    @csrf
                    <button class="btn btn-danger w-100">Logout</button>
                </form>
                @endif
            </div>

            <!-- Content -->
            <div id="content" class="p-3 d-flex flex-column">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-3">
                    <div class="container-fluid">
                        <button id="toggleSidebar" class="btn btn-outline-primary me-3">☰</button>
                        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">GPS TRACKER</a>

                        @php $admin = Auth::guard('admin')->user(); @endphp
                        @if($admin)
                        <div class="dropdown ms-auto">
                            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="profileDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=0D8ABC&color=fff&size=32"
                                    alt="profile" class="rounded-circle me-2">
                                <span class="d-none d-lg-inline fw-semibold">{{ $admin->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </div>
                </nav>

                <!-- Page Content -->
                <div class="flex-grow-1 overflow-auto">
                    @yield('page-content')
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <small>&copy; {{ date('Y') }} GPS Tracker | All Rights Reserved</small>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    </script>
    @yield('scripts')
</body>

</html>