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
    <meta name="description" content="MobilShift - Jual Beli Mobil Bekas">
    <meta name="keywords" content="mobil, bekas, jual, beli, otomotif">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MobilShift - Pesanan</title>

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
        --warning: #DC2626;
        --danger: #EF4444;
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
    .page-add {
        background: linear-gradient(135deg, var(--secondary), var(--primary)) !important;
        color: var(--dark);
    }

    .page-breadcrumb h2 {
        color: var(--dark) !important;
        font-weight: 700;
        font-size: 2.5rem;
        font-family: 'Comic Neue', cursive;
        text-shadow: 2px 2px 0px rgba(253, 224, 71, 0.5);
    }

    .page-breadcrumb h2 span {
        color: var(--white);
    }

    .page-breadcrumb p {
        color: var(--dark);
        opacity: 0.9;
        font-size: 1.1rem;
    }

    /* ===== ORDER CARD STYLES ===== */
    .order-card {
        background: var(--white);
        border: 3px solid var(--secondary);
        border-radius: 25px;
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(253, 224, 71, 0.2);
    }

    .order-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary);
        box-shadow: 0 15px 30px rgba(245, 158, 11, 0.2);
    }

    .order-card-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: var(--dark);
        padding: 20px;
        border-bottom: 3px solid var(--accent);
    }

    .order-card-body {
        padding: 25px;
    }

    .badge {
        padding: 8px 15px;
        border-radius: 15px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .bg-success {
        background: linear-gradient(135deg, var(--success), #059669) !important;
        color: var(--white) !important;
    }

    .bg-warning {
        background: linear-gradient(135deg, var(--primary), #D97706) !important;
        color: var(--white) !important;
    }

    .bg-danger {
        background: linear-gradient(135deg, var(--danger), #DC2626) !important;
        color: var(--white) !important;
    }

    /* ===== TABLE STYLES ===== */
    .table {
        border-radius: 15px;
        overflow: hidden;
        border: 2px solid var(--secondary);
    }

    .table-dark {
        background: linear-gradient(135deg, var(--secondary), var(--primary)) !important;
        border: none;
        color: var(--dark) !important;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: var(--neutral);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(245, 158, 11, 0.1);
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    /* ===== BUTTON STYLES ===== */
    .btn {
        padding: 10px 20px;
        border-radius: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--secondary), var(--primary));
        border: none;
        color: var(--dark);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(253, 224, 71, 0.4);
        color: var(--dark);
    }

    .btn-success {
        background: linear-gradient(135deg, var(--success), #059669);
        border: none;
        color: var(--white);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--danger), #DC2626);
        border: none;
        color: var(--white);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
    }

    .btn-warning {
        background: linear-gradient(135deg, var(--primary), #D97706);
        border: none;
        color: var(--white);
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 0.875rem;
    }

    /* ===== DROPDOWN STYLES ===== */
    .dropdown-menu {
        border: 2px solid var(--primary);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(245, 158, 11, 0.1);
        overflow: hidden;
    }

    .dropdown-item {
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: var(--primary);
        color: var(--white);
        padding-left: 20px;
    }

    /* ===== ALERT STYLES ===== */
    .alert-info {
        background: linear-gradient(135deg, var(--secondary), var(--primary));
        color: var(--dark);
        border: none;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(253, 224, 71, 0.3);
    }

    .alert-danger {
        background: linear-gradient(135deg, var(--danger), #DC2626);
        color: var(--white);
        border: none;
        border-radius: 15px;
        padding: 15px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
    }

    /* ===== FOOTER STYLES ===== */
    .footer-section {
        background-color: var(--primary);
        color: var(--dark);
        padding: 60px 0 0;
    }

    .single-footer-widget h4 {
        color: var(--white);
        font-weight: 700;
        font-size: 2rem;
        font-family: 'Comic Neue', cursive;
        margin-bottom: 20px;
    }

    .single-footer-widget p {
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 20px;
        color: var(--white);
    }

    .social-links-warp {
        background-color: var(--secondary);
        padding: 30px 0;
        margin-top: 40px;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .social-links a {
        background: var(--white);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
        position: relative;
    }

    .social-links a i {
        color: var(--primary);
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .social-links a span {
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--white);
        color: var(--primary);
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.7rem;
        opacity: 0;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .social-links a:hover {
        background: var(--accent);
        transform: scale(1.2) rotate(10deg);
    }

    .social-links a:hover i {
        color: var(--secondary);
        transform: scale(1.2);
    }

    .social-links a:hover span {
        opacity: 1;
        bottom: -30px;
    }

    /* ===== LOADING ===== */
    #preloder {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 9999;
        background: var(--white);
    }

    .loader {
        border: 5px solid var(--neutral);
        border-top: 5px solid var(--primary);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
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
        
        .page-breadcrumb h2 {
            font-size: 2rem;
        }
        
        .order-card-body {
            padding: 15px;
        }
        
        .d-flex.justify-content-end.gap-3 {
            flex-direction: column;
            gap: 10px !important;
        }
        
        .btn {
            width: 100%;
            text-align: center;
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
                        <span class="first-letter">M</span>obilShift
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
    <section class="page-add py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="page-breadcrumb">
                        <h2>Pesanan Anda<span>.</span></h2>
                        <p>Lihat riwayat pesanan dan detail pembelian Anda.</p>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-receipt fa-5x text-white opacity-75"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Orders Section -->
    <div class="container my-5">
        @if($orders->isEmpty())
            <div class="alert alert-info text-center py-4">
                <h4 class="fw-bold mb-3"><i class="fas fa-inbox me-2"></i>Belum Ada Pesanan</h4>
                <p class="mb-0">Anda belum memiliki riwayat pesanan. Mulai belanja sekarang!</p>
            </div>
        @else
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-card-header">
                        <div class="d-flex justify-content-between flex-column flex-md-row">
                            <div>
                                <h5 class="fw-bold">Order ID: {{ $order->order_id }}</h5>
                                <small>Tanggal: {{ $order->order_date }}</small><br>
                                @if(strtolower($order->status) === 'dikonfirmasi')
                                    <small class="text-warning">
                                        <i class="fas fa-clock me-1"></i>
                                        Batas pembayaran DP: 
                                        {{ \Carbon\Carbon::parse($order->order_date)->addDays(7)->format('d M Y') }}
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="order-card-body">
                        @if(strtolower($order->status) === 'batal')
                            <div class="alert alert-danger fw-bold text-center">
                                <i class="fas fa-times-circle me-2"></i>
                                Pesanan anda telah <u>Batal</u>, silahkan pesan ulang kembali!
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('cetak-struk', $order->order_id) }}" class="btn btn-primary btn-sm" target="_blank">
                                    <i class="fas fa-print me-1"></i>Cetak Struk
                                </a>
                            </div>
                        @else
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <p class="mb-2"><strong>Status:</strong></p>
                                    <span class="badge bg-{{ strtolower($order->status) === 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-2"><strong>Total Harga:</strong></p>
                                    <p class="text-primary fw-bold">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-2"><strong>Sisa Bayar:</strong></p>
                                    @if ($order->sisa_tagihan == 0)
                                        <span class="badge bg-success">LUNAS</span>
                                    @else
                                        <span class="text-danger fw-bold">Rp{{ number_format($order->sisa_tagihan, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered table-sm align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderDetails as $detail)
                                            <tr>
                                                <td>{{ $detail->product->product_name ?? 'Produk tidak ditemukan' }}</td>
                                                <td>{{ $detail->quantity }}</td>
                                                <td>Rp{{ number_format($detail->price, 0, ',', '.') }}</td>
                                                <td>Rp{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-4">
                                <a href="{{ route('cetak-struk', $order->order_id) }}" class="btn btn-primary btn-sm" target="_blank">
                                    <i class="fas fa-print me-1"></i>Cetak Struk
                                </a>

                                @if ($order->sisa_tagihan > 0 && strtolower($order->status) !== 'lunas' && strtolower($order->status) !== 'batal')
                                    <a href="{{ url('/public/pembayaran/create') . '?order_id=' . $order->order_id }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-credit-card me-1"></i>Pembayaran
                                    </a>
                                @endif

                                @if(strtolower($order->status) === 'dikonfirmasi')
                                    <button type="button" class="btn btn-danger btn-sm btn-cancel" data-id="{{ $order->order_id }}">
                                        <i class="fas fa-times me-1"></i>Batalkan Pesanan
                                    </button>
                                @endif

                                @if(strtolower($order->status) === 'lunas')
                                    <div class="dropdown">
                                        <button class="btn btn-warning btn-sm dropdown-toggle" type="button" id="pickupDropdown{{ $order->order_id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-truck me-1"></i>Pengambilan Mobil
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="pickupDropdown{{ $order->order_id }}">
                                            <li>
                                                <a class="dropdown-item change-logistik" href="#" data-id="{{ $order->order_id }}" data-status="request_pickup">
                                                    <i class="fas fa-clock me-2"></i>Request Pickup
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item change-logistik" href="#" data-id="{{ $order->order_id }}" data-status="pickup">
                                                    <i class="fas fa-check me-2"></i>Pickup
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @endif
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
                            <h4>Tentang MobilShift</h4>
                            <p>MobilShift adalah platform terpercaya untuk jual beli mobil bekas berkualitas. Kami menghubungkan pembeli dan penjual dengan menyediakan informasi yang transparan dan akurat tentang setiap kendaraan. Setiap mobil yang terdaftar di platform kami telah melalui proses verifikasi untuk memastikan kualitas dan keasliannya.</p>
                            <p>Dengan komitmen untuk memberikan pengalaman terbaik dalam berbelanja mobil bekas, kami terus berinovasi dalam menyajikan informasi yang lengkap dan membantu Anda menemukan mobil impian dengan harga yang terjangkau.</p>
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
                <p>&copy;<script>document.write(new Date().getFullYear());</script> MobilShift - All rights reserved</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Cancel Order
        document.querySelectorAll('.btn-cancel').forEach(button => {
            button.addEventListener('click', function() {
                if (!confirm('Yakin ingin membatalkan pesanan ini?')) return;

                const orderId = this.getAttribute('data-id');
                fetch(`/orders/${orderId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
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
                    console.error(error);
                });
            });
        });

        // Change Logistics
        document.querySelectorAll('.change-logistik').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-id');
                const newLogistik = this.getAttribute('data-status');

                fetch(`/orders/${orderId}/logistik`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json', 
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ logistik: newLogistik })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Gagal memperbarui logistik');
                    return response.json();
                })
                .then(data => {
                    alert(data.message || 'Logistik berhasil diubah!');
                    location.reload();
                })
                .catch(error => {
                    alert(error.message);
                    console.error(error);
                });
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
</body>
</html>