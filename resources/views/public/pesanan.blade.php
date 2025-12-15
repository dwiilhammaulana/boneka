@if(session('success'))
    <div class="alert alert-success alert-custom">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('berhasil'))
    <div class="alert alert-success alert-custom">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('berhasil') }}
    </div>
@endif

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="GoldenToys - Mainan Anak Terbaik">
    <meta name="keywords" content="mainan, anak, toys, edukasi, golden">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GoldenToys - Pesanan Saya</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Balsamiq+Sans:wght@400;700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">

   <style>
    :root {
        --primary: #FDE047;
        --secondary: #F59E0B;
        --accent: #6B7280;
        --neutral: #FFFBEB;
        --white: #FFFFFF;
        --dark: #374151;
        --success: #10B981;
        --warning: #F59E0B;
        --danger: #EF4444;
        --info: #3B82F6;
        --light-gray: #FEF3C7;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: var(--neutral);
        color: var(--dark);
        font-family: 'Quicksand', sans-serif;
        overflow-x: hidden;
        line-height: 1.6;
    }

    /* ===== HEADER STYLES ===== */
    .header-section {
        background-color: var(--white);
        border-bottom: 2px solid var(--primary);
        box-shadow: 0 2px 10px rgba(245, 158, 11, 0.1);
        padding: 12px 0;
        position: relative;
        z-index: 1000;
    }

    .inner-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .logo {
        flex: 0 0 auto;
    }

    .logo-text {
        font-size: 32px;
        font-weight: 700;
        color: var(--primary);
        text-decoration: none;
        font-family: 'Comic Neue', cursive;
        text-shadow: 2px 2px 0px var(--secondary);
        transition: all 0.3s ease;
    }

    .logo-text:hover {
        color: var(--accent);
        transform: scale(1.05);
    }

    .first-letter {
        color: var(--primary);
    }

    /* Main Menu */
    .main-menu {
        flex: 1;
        display: flex;
        justify-content: center;
    }

    .main-menu ul {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 30px;
        align-items: center;
    }

    .main-menu ul li {
        position: relative;
    }

    .main-menu ul li a {
        color: var(--dark);
        font-weight: 600;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 20px;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .main-menu ul li a:hover,
    .main-menu ul li a.active {
        color: var(--primary);
        background-color: var(--light-gray);
    }

    .main-menu ul li span {
        color: var(--dark);
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        padding: 8px 15px;
        border-radius: 20px;
    }

    /* Sub Menu */
    .sub-menu {
        position: absolute;
        top: 100%;
        left: 0;
        background: var(--white);
        border: 2px solid var(--primary);
        border-radius: 15px;
        min-width: 200px;
        box-shadow: 0 10px 30px rgba(245, 158, 11, 0.1);
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .main-menu ul li:hover .sub-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .sub-menu li {
        width: 100%;
        list-style: none;
    }

    .sub-menu li a {
        display: block;
        padding: 12px 20px;
        color: var(--dark) !important;
        transition: all 0.3s ease;
        border-radius: 0;
        text-decoration: none;
        border-bottom: 1px solid var(--light-gray);
    }

    .sub-menu li a:hover {
        background-color: var(--primary);
        color: var(--white) !important;
        padding-left: 25px;
    }

    .sub-menu form {
        padding: 0;
    }

    .sub-menu button {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        padding: 12px 20px;
        cursor: pointer;
        color: var(--danger) !important;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .sub-menu button:hover {
        background-color: var(--danger);
        color: var(--white) !important;
        padding-left: 25px;
    }

    /* Header Right */
    .header-right {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-left: auto;
    }

    .cart-icon, .login-icon {
        background-color: var(--primary);
        border-radius: 50%;
        padding: 10px;
        transition: all 0.3s ease;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: var(--white);
        position: relative;
    }

    .cart-icon:hover, .login-icon:hover {
        background-color: var(--secondary);
        transform: scale(1.1);
        color: var(--dark);
    }

    .header-right i {
        color: var(--white);
        font-size: 1.2rem;
    }

    .cart-icon:hover i, .login-icon:hover i {
        color: var(--dark);
    }

    .cart-badge {
        background: var(--accent);
        color: var(--white);
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 0.7rem;
        position: absolute;
        top: -5px;
        right: -5px;
        font-weight: bold;
        min-width: 18px;
        text-align: center;
    }

    /* ===== ALERT STYLES ===== */
    .alert-custom {
        background: linear-gradient(135deg, var(--success), #059669);
        color: var(--white);
        border: none;
        border-radius: 15px;
        padding: 15px 20px;
        margin: 20px 0;
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        border-left: 4px solid var(--white);
    }

    /* ===== PAGE HEADER STYLES ===== */
    .page-header {
        background: linear-gradient(135deg, var(--secondary), var(--primary));
        color: var(--dark);
        padding: 60px 0 30px;
        margin-bottom: 30px;
        border-bottom: 3px solid var(--accent);
    }

    .page-title {
        font-family: 'Comic Neue', cursive;
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 10px;
        text-shadow: 2px 2px 0px rgba(253, 224, 71, 0.5);
    }

    .page-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* ===== STATUS FILTER STYLES ===== */
    .status-filter {
        background: var(--white);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
        border: 2px solid var(--primary);
        box-shadow: 0 5px 15px rgba(253, 224, 71, 0.1);
    }

    .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }

    .status-btn {
        padding: 10px 20px;
        border-radius: 25px;
        border: 2px solid var(--primary);
        background: var(--white);
        color: var(--dark);
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .status-btn:hover,
    .status-btn.active {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
    }

    /* ===== ORDER CARD STYLES ===== */
    .order-card {
        background: var(--white);
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 25px;
        border: 2px solid var(--light-gray);
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .order-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary);
        box-shadow: 0 15px 30px rgba(245, 158, 11, 0.15);
    }

    .order-header {
        background: linear-gradient(135deg, var(--light-gray), #FEF9C3);
        padding: 20px;
        border-bottom: 2px solid var(--primary);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .order-info {
        flex: 1;
        min-width: 300px;
    }

    .order-id {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .order-date {
        color: var(--accent);
        font-size: 0.9rem;
    }

    .order-status-badge {
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-menunggu {
        background: linear-gradient(135deg, var(--warning), #D97706);
        color: var(--white);
    }

    .status-diproses {
        background: linear-gradient(135deg, var(--info), #2563EB);
        color: var(--white);
    }

    .status-dikirim {
        background: linear-gradient(135deg, var(--primary), #F59E0B);
        color: var(--white);
    }

    .status-selesai {
        background: linear-gradient(135deg, var(--success), #059669);
        color: var(--white);
    }

    .status-dibatalkan {
        background: linear-gradient(135deg, var(--danger), #DC2626);
        color: var(--white);
    }

    .order-body {
        padding: 25px;
    }

    .order-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
        padding: 20px;
        background: var(--neutral);
        border-radius: 15px;
        border: 1px solid var(--light-gray);
    }

    .summary-item {
        display: flex;
        flex-direction: column;
    }

    .summary-label {
        font-size: 0.9rem;
        color: var(--accent);
        margin-bottom: 5px;
    }

    .summary-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
    }

    .truncate-text {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-height: 3em;
    }

    .order-items {
        margin-top: 20px;
    }

    .item-card {
        display: flex;
        align-items: center;
        padding: 15px;
        background: var(--white);
        border-radius: 10px;
        margin-bottom: 10px;
        border: 1px solid var(--light-gray);
        transition: all 0.3s ease;
    }

    .item-card:hover {
        background: var(--neutral);
        border-color: var(--primary);
    }

    .item-image {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        overflow: hidden;
        margin-right: 15px;
        flex-shrink: 0;
        border: 2px solid var(--primary);
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .item-price {
        color: var(--secondary);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .item-qty {
        color: var(--accent);
        font-size: 0.9rem;
    }

    .order-actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 2px solid var(--light-gray);
        flex-wrap: wrap;
    }

    .action-btn {
        padding: 10px 20px;
        border-radius: 15px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--secondary), var(--primary));
        color: var(--dark);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
    }

    .btn-outline {
        background: transparent;
        border-color: var(--primary);
        color: var(--dark);
    }

    .btn-outline:hover {
        background: var(--primary);
        color: var(--white);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--danger), #DC2626);
        color: var(--white);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
    }

    .customer-note {
        background: var(--light-gray);
        padding: 15px;
        border-radius: 10px;
        margin-top: 15px;
        border-left: 4px solid var(--primary);
    }

    .note-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .note-text {
        color: var(--accent);
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: var(--white);
        border-radius: 20px;
        border: 2px dashed var(--primary);
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--primary);
        margin-bottom: 20px;
    }

    .empty-state-filtered {
        padding: 40px 20px;
        background: var(--white);
        border-radius: 15px;
        border: 2px solid var(--light-gray);
        text-align: center;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .inner-header {
            flex-direction: column;
            gap: 15px;
        }
        
        .main-menu ul {
            flex-direction: column;
            gap: 10px;
        }
        
        .logo-text {
            font-size: 24px;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .order-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .order-info {
            min-width: 100%;
        }
        
        .filter-buttons {
            flex-direction: column;
        }
        
        .status-btn {
            width: 100%;
            text-align: center;
        }
        
        .order-summary {
            grid-template-columns: 1fr;
        }
        
        .order-actions {
            flex-direction: column;
        }
        
        .action-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section -->
    <header class="header-section">
        <div class="container-fluid">
            <div class="inner-header">
                <div class="logo">
                    <a href="{{ route('public.home') }}" class="logo-text">
                        <span class="first-letter"></span>GoldenToys
                    </a>
                </div>

                <!-- Navigation Menu -->
                <nav class="main-menu mobile-menu">
                    <ul>
                        <li><a href="{{ route('public.home') }}">Home</a></li>
                        <li><a href="{{ route('public.shop') }}">Shop</a></li>
                        <li><a href="{{ route('public.contact') }}">Contact</a></li>
                        
                        @if(Auth::guard('customer')->check())
                            <li>
                                <span>Profile</span>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('customer.profile') }}">{{ Auth::guard('customer')->user()->username }}</a></li>
                                    <li>
                                        <form action="{{ route('customer.logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="{{ route('public.pesanan') }}" class="active">Pesanan</a></li>
                        @else
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @endif
                    </ul>
                </nav>

                <!-- User & Cart Icons -->
                <div class="header-right">
                    @auth('customer')
                        <a href="{{ route('public.cart') }}" class="cart-icon">
                            <i class="fas fa-shopping-bag"></i>
                            <span class="cart-badge">{{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}</span>
                        </a>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="login-icon">
                            <i class="fas fa-user"></i>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="page-title">Pesanan Saya</h1>
                    <p class="page-subtitle">Kelola dan lacak pesanan Anda di satu tempat</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-shopping-bag fa-4x text-white opacity-75"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Status Filter -->
    <div class="container">
        <div class="status-filter">
            <div class="filter-buttons">
                <a href="{{ route('public.pesanan') }}" class="status-btn {{ !request('status') ? 'active' : '' }}">
                    <i class="fas fa-list me-2"></i>Semua Pesanan
                </a>
                <a href="{{ route('public.pesanan', ['status' => 'menunggu']) }}" class="status-btn {{ request('status') == 'menunggu' ? 'active' : '' }}">
                    <i class="fas fa-clock me-2"></i>Menunggu ({{ $statusCounts['menunggu'] ?? 0 }})
                </a>
                <a href="{{ route('public.pesanan', ['status' => 'diproses']) }}" class="status-btn {{ request('status') == 'diproses' ? 'active' : '' }}">
                    <i class="fas fa-cog me-2"></i>Diproses ({{ $statusCounts['diproses'] ?? 0 }})
                </a>
                <a href="{{ route('public.pesanan', ['status' => 'dikirim']) }}" class="status-btn {{ request('status') == 'dikirim' ? 'active' : '' }}">
                    <i class="fas fa-truck me-2"></i>Dikirim ({{ $statusCounts['dikirim'] ?? 0 }})
                </a>
                <a href="{{ route('public.pesanan', ['status' => 'selesai']) }}" class="status-btn {{ request('status') == 'selesai' ? 'active' : '' }}">
                    <i class="fas fa-check-circle me-2"></i>Selesai ({{ $statusCounts['selesai'] ?? 0 }})
                </a>
                <a href="{{ route('public.pesanan', ['status' => 'dibatalkan']) }}" class="status-btn {{ request('status') == 'dibatalkan' ? 'active' : '' }}">
                    <i class="fas fa-times-circle me-2"></i>Dibatalkan ({{ $statusCounts['dibatalkan'] ?? 0 }})
                </a>
            </div>
        </div>
    </div>

    <!-- Orders Content -->
    <div class="container my-5">
        @if($orders->isEmpty())
            @if(request('status'))
                <div class="empty-state-filtered">
                    <div class="empty-icon mb-3">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h3 class="mb-3">Tidak Ada Pesanan dengan Status "{{ ucfirst(request('status')) }}"</h3>
                    <p class="text-muted mb-4">Anda belum memiliki pesanan dengan status ini.</p>
                    <a href="{{ route('public.pesanan') }}" class="action-btn btn-outline">
                        <i class="fas fa-arrow-left me-2"></i>Lihat Semua Pesanan
                    </a>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <h3 class="mb-3">Belum Ada Pesanan</h3>
                    <p class="text-muted mb-4">Anda belum memiliki riwayat pesanan. Mulai belanja sekarang!</p>
                    <a href="{{ route('public.shop') }}" class="action-btn btn-primary">
                        <i class="fas fa-shopping-cart me-2"></i>Mulai Berbelanja
                    </a>
                </div>
            @endif
        @else
            @foreach($orders as $order)
                <div class="order-card" data-status="{{ $order->status }}">
                    <div class="order-header">
                        <div class="order-info">
                            <div class="order-id">Order ID: #{{ $order->order_id }}</div>
                            <div class="order-date">
                                <i class="far fa-calendar me-1"></i>
                                {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y H:i') }}
                            </div>
                        </div>
                        <div class="order-status-badge status-{{ $order->status }}">
                            @if($order->status == 'menunggu')
                                <i class="fas fa-clock me-1"></i>Menunggu Pembayaran
                            @elseif($order->status == 'diproses')
                                <i class="fas fa-cog me-1"></i>Diproses
                            @elseif($order->status == 'dikirim')
                                <i class="fas fa-truck me-1"></i>Dikirim
                            @elseif($order->status == 'selesai')
                                <i class="fas fa-check-circle me-1"></i>Selesai
                            @elseif($order->status == 'dibatalkan')
                                <i class="fas fa-times-circle me-1"></i>Dibatalkan
                            @endif
                        </div>
                    </div>

                    <div class="order-body">
                        <!-- Alert untuk order yang perlu dibayar -->
                        @if($order->status == 'menunggu' && $order->payment_method == 'gateway')
                            <div class="alert alert-warning alert-custom mb-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Pembayaran Belum Dilakukan!</strong> 
                                Silakan lakukan pembayaran untuk melanjutkan proses pengiriman.
                            </div>
                        @endif

                        <!-- Order Summary -->
                        <div class="order-summary">
                            <div class="summary-item">
                                <span class="summary-label">Nama Penerima</span>
                                <span class="summary-value">{{ $order->receiver_name }}</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Telepon</span>
                                <span class="summary-value">{{ $order->receiver_phone }}</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Alamat</span>
                                <span class="summary-value truncate-text" title="{{ $order->shipping_address }}">
                                    {{ $order->shipping_address }}
                                </span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Metode Pembayaran</span>
                                <span class="summary-value">
                                    @if($order->payment_method == 'cod')
                                        <i class="fas fa-money-bill-wave me-1"></i>COD
                                    @else
                                        <i class="fas fa-credit-card me-1"></i>Gateway
                                    @endif
                                </span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Status Pembayaran</span>
                                <span class="summary-value">
                                    @if($order->status == 'menunggu' && $order->payment_method == 'gateway')
                                        <span class="text-warning">
                                            <i class="fas fa-clock"></i> Menunggu Pembayaran
                                        </span>
                                    @elseif($order->payment_method == 'cod')
                                        <span class="text-info">
                                            <i class="fas fa-money-bill-wave"></i> Bayar saat terima
                                        </span>
                                    @elseif($order->status != 'menunggu' && $order->payment_method == 'gateway')
                                        <span class="text-success">
                                            <i class="fas fa-check-circle"></i> Sudah Dibayar
                                        </span>
                                    @endif
                                </span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Total Pesanan</span>
                                <span class="summary-value text-success">
                                    Rp{{ number_format($order->grand_total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="order-items">
                            <h6 class="mb-3"><i class="fas fa-box-open me-2"></i>Detail Produk ({{ $order->orderDetails->count() }})</h6>
                            @foreach($order->orderDetails as $detail)
                                <div class="item-card">
                                    <div class="item-image">
                                        @if($detail->product && $detail->product->image_url)
                                            <img src="{{ asset('img/' . $detail->product->image_url) }}" alt="{{ $detail->product->product_name }}">
                                        @else
                                            <div style="width: 100%; height: 100%; background: var(--light-gray); display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-image text-primary"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="item-details">
                                        <div class="item-name">{{ $detail->product->product_name ?? 'Produk tidak ditemukan' }}</div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="item-price">Rp{{ number_format($detail->price, 0, ',', '.') }}</span>
                                            <span class="item-qty">x{{ $detail->quantity }}</span>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">Subtotal: Rp{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Customer Note -->
                        @if($order->customer_note)
                            <div class="customer-note">
                                <div class="note-label">
                                    <i class="fas fa-sticky-note"></i>
                                    Catatan Anda:
                                </div>
                                <div class="note-text truncate-text" title="{{ $order->customer_note }}">
                                    {{ $order->customer_note }}
                                </div>
                            </div>
                        @endif

                        <!-- Order Actions -->
                        <div class="order-actions">
                            <a href="{{ route('cetak-struk', $order->order_id) }}" class="action-btn btn-primary" target="_blank">
                                <i class="fas fa-print"></i>Cetak Struk
                            </a>
                            
                            @if($order->status == 'menunggu')
                                <!-- Tampilkan tombol Bayar hanya untuk pembayaran gateway (non-COD) -->
                                @if($order->payment_method == 'gateway')
                                    <a href="{{ url('public/pembayaran/create') . '?order_id=' . $order->order_id }}" class="action-btn btn-success">
                                        <i class="fas fa-credit-card"></i>Bayar Sekarang
                                    </a>
                                @endif
                                
                                <!-- Tombol Batalkan tetap muncul untuk semua status menunggu -->
                                <button type="button" class="action-btn btn-danger btn-cancel" data-id="{{ $order->order_id }}">
                                    <i class="fas fa-times"></i>Batalkan Pesanan
                                </button>
                            @endif
                            
                            @if($order->status == 'dikirim')
                                <button type="button" class="action-btn btn-primary btn-confirm" data-id="{{ $order->order_id }}">
                                    <i class="fas fa-check"></i>Konfirmasi Diterima
                                </button>
                            @endif
                            
                            @if($order->status == 'selesai')
                                <a href="#" class="action-btn btn-outline">
                                    <i class="fas fa-star"></i>Beri Ulasan
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Footer Section -->
    <footer class="footer-section spad">
        <div class="container">
            <div class="footer-widget">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="single-footer-widget">
                            <h4>Tentang GoldenToys</h4>
                            <p>GoldenToys adalah platform terpercaya untuk jual beli mainan anak berkualitas. Kami menghubungkan pembeli dan penjual dengan menyediakan informasi yang transparan dan akurat tentang setiap produk.</p>
                            <p>Dengan komitmen untuk memberikan pengalaman terbaik dalam berbelanja mainan, kami terus berinovasi dalam menyajikan informasi yang lengkap dan membantu Anda menemukan mainan terbaik untuk anak Anda.</p>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="social-links-warp">
            <div class="container text-center">
                <div class="social-links">
                    <a href="#" class="instagram"><i class="fab fa-instagram"></i><span>Instagram</span></a>
                    <a href="#" class="facebook"><i class="fab fa-facebook"></i><span>Facebook</span></a>
                    <a href="#" class="twitter"><i class="fab fa-twitter"></i><span>Twitter</span></a>
                    <a href="#" class="youtube"><i class="fab fa-youtube"></i><span>YouTube</span></a>
                </div>
            </div>
            <div class="container text-center pt-3">
                <p>&copy;<script>document.write(new Date().getFullYear());</script> GoldenToys - All rights reserved</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Cancel Order - hanya untuk status menunggu
        document.querySelectorAll('.btn-cancel').forEach(button => {
            button.addEventListener('click', function() {
                if (!confirm('Yakin ingin membatalkan pesanan ini?\nPesanan yang dibatalkan tidak dapat dikembalikan.')) return;

                const orderId = this.getAttribute('data-id');
                const button = this;
                
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>Memproses...';
                button.disabled = true;

                fetch(`/orders/${orderId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Gagal membatalkan pesanan');
                    return response.json();
                })
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(error => {
                    alert(error.message);
                    button.innerHTML = '<i class="fas fa-times"></i>Batalkan Pesanan';
                    button.disabled = false;
                    console.error(error);
                });
            });
        });

        // Confirm Order Received - hanya untuk status dikirim
        document.querySelectorAll('.btn-confirm').forEach(button => {
            button.addEventListener('click', function() {
                if (!confirm('Apakah Anda sudah menerima pesanan ini?\nDengan mengkonfirmasi, pesanan akan ditandai sebagai selesai.')) return;

                const orderId = this.getAttribute('data-id');
                const button = this;
                
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>Memproses...';
                button.disabled = true;

                fetch(`/orders/${orderId}/complete`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Gagal mengkonfirmasi pesanan');
                    return response.json();
                })
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(error => {
                    alert(error.message);
                    button.innerHTML = '<i class="fas fa-check"></i>Konfirmasi Diterima';
                    button.disabled = false;
                    console.error(error);
                });
            });
        });

        // Tampilkan teks lengkap saat hover pada truncated text
        document.querySelectorAll('.truncate-text').forEach(element => {
            element.addEventListener('mouseenter', function() {
                const title = this.getAttribute('title');
                if (title && this.scrollHeight > this.clientHeight) {
                    // Tampilkan tooltip custom
                    const tooltip = document.createElement('div');
                    tooltip.className = 'custom-tooltip';
                    tooltip.textContent = title;
                    tooltip.style.position = 'absolute';
                    tooltip.style.background = 'var(--dark)';
                    tooltip.style.color = 'var(--white)';
                    tooltip.style.padding = '10px';
                    tooltip.style.borderRadius = '5px';
                    tooltip.style.zIndex = '10000';
                    tooltip.style.maxWidth = '400px';
                    tooltip.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
                    
                    const rect = this.getBoundingClientRect();
                    tooltip.style.left = rect.left + 'px';
                    tooltip.style.top = rect.bottom + 5 + 'px';
                    
                    document.body.appendChild(tooltip);
                    
                    this.addEventListener('mouseleave', function() {
                        if (document.body.contains(tooltip)) {
                            document.body.removeChild(tooltip);
                        }
                    });
                }
            });
        });

        // Preloader
        $(window).on('load', function () {
            $("#preloder").delay(600).fadeOut("slow");
        });

        // Auto-dismiss alerts
        setTimeout(function () {
            document.querySelectorAll('.alert-custom').forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>

    <style>
        .custom-tooltip {
            animation: fadeIn 0.2s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* CSS untuk tombol success (bayar) */
        .btn-success {
            background: linear-gradient(135deg, #10B981, #059669);
            color: var(--white);
            border: 2px solid transparent;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
            background: linear-gradient(135deg, #059669, #047857);
        }
        
        /* CSS untuk alert warning */
        .alert-warning {
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: var(--white);
            border: none;
            border-radius: 15px;
            padding: 15px 20px;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
            border-left: 4px solid var(--white);
        }
    </style>
</body>
</html>