<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Penjualan Baju')</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --sidebar-bg: #f4f6f9;
            --content-bg: #fdfdfd;
            --hover-color: #e2e6ea;
            --text-color: #343a40;
            --border-radius: 1rem;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: var(--content-bg);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .navbar .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
            color: #fff;
        }

        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            border-right: 1px solid #dee2e6;
            padding: 1.5rem 1rem;
            height: 100vh;
            position: sticky;
            top: 0;
        }

        .sidebar .nav-link {
            color: var(--text-color);
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            transition: background-color 0.2s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: var(--hover-color);
            font-weight: 500;
        }

        .main-content {
            flex: 1;
            display: flex;
        }

        .content {
            flex: 1;
            padding: 2rem;
            background-color: var(--content-bg);
        }

        .card {
            border-radius: var(--border-radius);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border: none;
        }

        .dropdown-menu {
            border-radius: var(--border-radius);
        }

        .offcanvas {
            background-color: var(--sidebar-bg);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark px-3">
        <a class="navbar-brand" href="#">Jual Beli Mobil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="ms-auto dropdown">
            <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle"></i> {{ Auth::guard('admin')->user()->username }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><form action="{{ route('admin.logout') }}" method="POST">@csrf <button type="submit" class="dropdown-item text-danger">Keluar</button></form></li>
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <!-- Sidebar -->
        <aside class="sidebar d-none d-lg-block">
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                <a class="nav-link" href="{{ route('admin.index') }}"><i class="bi bi-person-badge me-2"></i> Admin</a>
                <a class="nav-link" href="{{ route('categories.index') }}"><i class="bi bi-tags me-2"></i> Kategori</a>
                <a class="nav-link" href="{{ route('products.index') }}"><i class="bi bi-box-seam me-2"></i> Produk</a>
                <a class="nav-link" href="{{ route('orders.index') }}"><i class="bi bi-receipt me-2"></i> Pesanan</a>
                <a class="nav-link" href="{{ route('pembayaran.index') }}"><i class="bi bi-cash-stack me-2"></i> Pembayaran</a>
                <a class="nav-link" href="{{ route('customers.index') }}"><i class="bi bi-people me-2"></i> Pengguna</a>
                <a class="nav-link" href="{{ route('contact_us.index') }}"><i class="bi bi-envelope me-2"></i> Kontak</a>
                <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#laporanMenu"><i class="bi bi-bar-chart me-2"></i> Laporan</a>
                <div class="collapse" id="laporanMenu">
                    <a class="nav-link ms-4" href="{{ route('laporan.penjualan') }}">Penjualan</a>
                    <a class="nav-link ms-4" href="{{ route('laporan.mobil_customer') }}">Pembelian</a>
                </div>
            </nav>
        </aside>

        <!-- Mobile Sidebar -->
        <div class="offcanvas offcanvas-start d-lg-none" id="sidebarOffcanvas">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menu</h5>
                <button class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <a class="nav-link" href="{{ route('dashboard.index') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('admin.index') }}">Admin</a>
                <a class="nav-link" href="{{ route('categories.index') }}">Kategori</a>
                <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
                <a class="nav-link" href="{{ route('orders.index') }}">Pesanan</a>
                <a class="nav-link" href="{{ route('pembayaran.index') }}">Pembayaran</a>
                <a class="nav-link" href="{{ route('customers.index') }}">Pengguna</a>
                <a class="nav-link" href="{{ route('contact_us.index') }}">Kontak</a>
            </div>
        </div>

        <!-- Content -->
        <main class="content">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
