@if(session('success'))
    <div class="alert alert-success alert-custom">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-custom">
        <i class="fas fa-exclamation-circle me-2"></i>
        {{ session('error') }}
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
    <title>GoldenToys - Cart</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Balsamiq+Sans:wght@400;700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">

    <style>
        :root {
            --yellow: #FDE047;
            --dark-yellow: #F59E0B;
            --orange: #FB923C;
            --blue: #7DD3FC;
            --white: #FFFFFF;
            --light-bg: #FFFDF0;
            --pink: #FF85A2;
            --purple: #A78BFA;
            --green: #4ADE80;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--light-bg);
            color: #4A5568;
            font-family: 'Quicksand', sans-serif;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ===== HEADER STYLES ===== */
        .header-section {
            background-color: var(--white);
            border-bottom: 3px solid var(--yellow);
            box-shadow: 0 2px 15px rgba(253, 224, 71, 0.2);
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

        .logo h4 {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark-yellow);
            text-decoration: none;
            font-family: 'Comic Neue', cursive;
            text-shadow: 2px 2px 0px var(--yellow);
            transition: all 0.3s ease;
            margin: 0;
        }

        .logo h4:hover {
            color: var(--orange);
            transform: scale(1.05);
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
            color: #4A5568;
            font-weight: 600;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .main-menu ul li a:hover,
        .main-menu ul li a.active {
            color: var(--dark-yellow);
            background-color: var(--yellow);
        }

        .main-menu ul li span {
            color: #4A5568;
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
            border: 2px solid var(--yellow);
            border-radius: 15px;
            min-width: 200px;
            box-shadow: 0 10px 30px rgba(253, 224, 71, 0.3);
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
            color: #4A5568 !important;
            transition: all 0.3s ease;
            border-radius: 0;
            text-decoration: none;
            border-bottom: 1px solid #f0f0f0;
        }

        .sub-menu li a:hover {
            background-color: var(--yellow);
            color: #4A5568 !important;
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
            color: #dc3545 !important;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .sub-menu button:hover {
            background-color: #dc3545;
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
            background-color: var(--yellow);
            border-radius: 50%;
            padding: 10px;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #4A5568;
            position: relative;
        }

        .cart-icon:hover, .login-icon:hover {
            background-color: var(--dark-yellow);
            transform: scale(1.1);
            color: var(--white);
        }

        .header-right i {
            font-size: 1.2rem;
        }

        .cart-badge {
            background: var(--orange);
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

        /* ===== HEADER INFO ===== */
        .header-info {
            background-color: var(--yellow);
            border-bottom: 2px solid var(--orange);
            padding: 15px 0;
        }

        .header-item {
            background: var(--white);
            border-radius: 20px;
            padding: 20px;
            border: 3px solid var(--blue);
            transition: all 0.3s ease;
            text-align: center;
            height: 100%;
        }

        .header-item:hover {
            transform: translateY(-5px);
            border-color: var(--dark-yellow);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.2);
        }

        .header-item i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--dark-yellow);
        }

        .header-item p {
            margin: 0;
            font-weight: 500;
            color: #4A5568;
        }

        /* ===== ALERT STYLES ===== */
        .alert-custom {
            background: linear-gradient(135deg, var(--green), #28a745);
            color: var(--white);
            border: none;
            border-radius: 15px;
            padding: 15px 20px;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
            border-left: 4px solid var(--white);
        }

        .alert-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: var(--white);
            border: none;
            border-radius: 15px;
            padding: 15px 20px;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
            border-left: 4px solid var(--white);
        }

        /* ===== PAGE HEADER STYLES ===== */
        .page-add {
            background: linear-gradient(135deg, var(--yellow), var(--orange)) !important;
            color: #4A5568;
            padding: 60px 0;
        }

        .page-breadcrumb h2 {
            color: #4A5568 !important;
            font-weight: 700;
            font-size: 2.5rem;
            font-family: 'Comic Neue', cursive;
            text-shadow: 2px 2px 0px rgba(255, 255, 255, 0.5);
        }

        .page-breadcrumb h2 span {
            color: var(--white);
        }

        .page-breadcrumb a {
            color: #4A5568;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .page-breadcrumb a:hover {
            color: var(--white);
        }

        .page-breadcrumb a.active {
            color: var(--white);
            font-weight: 600;
        }

        /* ===== CART STYLES ===== */
        .cart-page {
            padding: 80px 0;
            background-color: var(--white);
        }

        .cart-table {
            background: var(--white);
            border: 3px solid var(--yellow);
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(253, 224, 71, 0.2);
            margin-bottom: 40px;
        }

        .cart-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-table thead {
            background: linear-gradient(135deg, var(--yellow), var(--orange));
        }

        .cart-table th {
            padding: 20px;
            color: #4A5568;
            font-weight: 700;
            font-size: 1.1rem;
            text-align: left;
            border-bottom: 2px solid var(--dark-yellow);
        }

        .cart-table td {
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .cart-table tbody tr:hover {
            background-color: rgba(253, 224, 71, 0.1);
        }

        .product-col {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 15px;
            border: 2px solid var(--yellow);
        }

        .no-image {
            width: 80px;
            height: 80px;
            background: var(--light-bg);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6B7280;
            font-size: 0.8rem;
            border: 2px dashed var(--yellow);
        }

        .p-title h5 {
            margin: 0;
            font-weight: 600;
            color: #4A5568;
            font-size: 1rem;
        }

        .price-col, .total-col {
            font-weight: 700;
            color: var(--dark-yellow);
            font-size: 1.1rem;
        }

        .quantity-col {
            text-align: center;
        }

        .styled-input {
            width: 60px;
            height: 40px;
            padding: 5px;
            text-align: center;
            font-size: 16px;
            border: 2px solid var(--yellow);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(253, 224, 71, 0.2);
            transition: all 0.3s ease;
            background-color: var(--light-bg);
        }

        .styled-input:hover {
            border-color: var(--dark-yellow);
        }

        .styled-input:focus {
            outline: none;
            border-color: var(--orange);
            box-shadow: 0 0 5px rgba(251, 146, 60, 0.5);
        }

        .product-close .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            border-radius: 10px;
            padding: 8px 15px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .product-close .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        /* ===== SHOPPING METHOD ===== */
        .shopping-method {
            background: var(--light-bg);
            padding: 40px 0;
            border-radius: 25px;
        }

        .total-info {
            background: var(--white);
            border: 3px solid var(--yellow);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(253, 224, 71, 0.2);
        }

        .total-table {
            margin-bottom: 30px;
        }

        .total-table table {
            width: 100%;
        }

        .total-cart {
            font-weight: 700;
            font-size: 1.3rem;
            color: #4A5568;
            padding: 15px 0;
            border-bottom: 2px solid var(--yellow);
        }

        .total-cart-p {
            font-weight: 700;
            font-size: 2rem;
            color: var(--dark-yellow);
            padding: 20px 0;
            text-align: center;
        }

        .primary-btn {
            background: linear-gradient(135deg, var(--yellow), var(--orange));
            color: #4A5568;
            border: none;
            padding: 15px 35px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(253, 224, 71, 0.4);
            display: inline-block;
        }

        .primary-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(253, 224, 71, 0.6);
            color: #4A5568;
            background: linear-gradient(135deg, var(--orange), var(--yellow));
        }

        /* ===== FOOTER STYLES ===== */
        .footer-section {
            background-color: var(--orange);
            color: #4A5568;
            padding: 60px 0 0;
        }

        .single-footer-widget h4 {
            color: var(--white);
            font-weight: 700;
            font-size: 1.5rem;
            font-family: 'Comic Neue', cursive;
            margin-bottom: 20px;
        }

        .single-footer-widget ul {
            list-style: none;
            padding: 0;
        }

        .single-footer-widget ul li {
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #4A5568;
        }

        .single-footer-widget ul li:hover {
            color: var(--white);
            transform: translateX(5px);
        }

        .social-links-warp {
            background-color: var(--dark-yellow);
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
            color: var(--dark-yellow);
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .social-links a span {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--white);
            color: var(--dark-yellow);
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.7rem;
            opacity: 0;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .social-links a:hover {
            background: var(--yellow);
            transform: scale(1.2) rotate(10deg);
        }

        .social-links a:hover i {
            color: var(--orange);
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
            border: 5px solid var(--light-bg);
            border-top: 5px solid var(--yellow);
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
            
            .logo h4 {
                font-size: 24px;
            }
            
            .page-breadcrumb h2 {
                font-size: 2rem;
            }
            
            .product-col {
                flex-direction: column;
                text-align: center;
            }
            
            .cart-table {
                overflow-x: auto;
            }
            
            .primary-btn {
                width: 100%;
                text-align: center;
            }
            
            .header-item {
                margin-bottom: 15px;
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
                    <a href="{{ route('public.home') }}"><h4>GoldenToys</h4></a>
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
                            <li><a href="{{ route('public.pesanan') }}">Pesanan</a></li>
                        @else
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @endif
                    </ul>
                </nav>

                <!-- User & Cart Icons -->
<!-- User & Cart Icons -->
<div class="header-right">
    @auth('customer')
        <a class="cart-icon active" href="{{ route('public.cart') }}">
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

    <!-- Header Info -->
    <div class="header-info">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="header-item">
                        <i class="fas fa-shipping-fast fa-3x mb-3"></i>
                        <p>Gratis pengiriman untuk pesanan di atas Rp 500.000</p>
                    </div>
                </div>
                <div class="col-md-4 text-left text-lg-center">
                    <div class="header-item">
                        <i class="fas fa-tag fa-3x mb-3"></i>
                        <p>Diskon 20% untuk Pelajar</p>
                    </div>
                </div>
                <div class="col-md-4 text-left text-xl-right">
                    <div class="header-item">
                        <i class="fas fa-percentage fa-3x mb-3"></i>
                        <p>30% off semua mobil. Gunakan kode: MOBIL30</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Header -->
<section class="page-add py-5 text-white" style="background: linear-gradient(135deg, #ff8c94, #ffaaa5);">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <!-- Breadcrumb dan Judul -->
            <div class="col-lg-8 col-md-7 mb-4 mb-md-0">
                <div class="page-breadcrumb">
                    <h2 class="fw-bold mb-2">Keranjang Belanja<span class="text-light">.</span></h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('public.home') }}" class="text-white text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('public.shop') }}" class="text-white text-decoration-none">Shop</a></li>
                            <li class="breadcrumb-item active text-light" aria-current="page">Keranjang</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Ikon Keranjang -->
            <div class="col-lg-4 col-md-5 text-center">
                <i class="fas fa-shopping-cart fa-5x text-white opacity-75" style="filter: drop-shadow(0 3px 6px rgba(0,0,0,0.3));"></i>
            </div>
        </div>
    </div>
</section>


    <!-- Cart Page Section -->
    <div class="cart-page">
        <div class="container">
            <div class="cart-table">
                <table>
                    <thead>
                        <tr>
                            <th class="product-col">Produk</th>
                            <th class="price-col text-left">Harga</th>
                            <th class="quantity-col text-center">Quantity</th>
                            <th class="total-col text-left">Total</th>
                            <th class="action-col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('cart') && count(session('cart')) > 0)
                            @foreach(session('cart') as $id => $details)
                                <tr>
                                    <td class="product-col">
                                        @if(!empty($details['image']))
                                            <img src="{{ asset('img/' . $details['image']) }}" alt="{{ $details['name'] }}" class="product-img">
                                        @else
                                            <div class="no-image">Gambar tidak tersedia</div>
                                        @endif
                                        <div class="p-title">
                                            <h5>{{ $details['name'] }}</h5>
                                            <h6 class="text-muted">Warna: {{ $details['warna'] }}</h6>
                                            <h6 class="text-muted">Kilometer: {{ $details['kilometer'] }}</h6>
                                        </div>
                                    </td>
                                    <td class="price-col text-left">Rp{{ number_format($details['price'], 0, ',', '.') }}</td>
                                    <td class="quantity-col text-center">
                                        {{ $details['quantity'] }}
                                    </td>
                                    <td class="total-col text-left">Rp{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                                    <td class="product-close">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeItem({{ $id }})">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Keranjang Anda kosong.</h5>
                                    <a href="{{ route('public.shop') }}" class="primary-btn mt-3">Mulai Belanja</a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        
        @if(session('cart') && count(session('cart')) > 0)
        <div class="shopping-method">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="total-info">
                            <div class="total-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="total-cart">Total Harga Keranjang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @php
                                                $total = 0;
                                                foreach(session('cart') as $id => $details) {
                                                    $total += $details['price'] * $details['quantity'];
                                                }
                                            @endphp
                                            <td class="total-cart-p">Rp{{ number_format($total, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <a href="{{ route('checkout') }}" class="primary-btn chechout-btn">
                                        <i class="fas fa-credit-card me-2"></i>Lanjut ke Checkout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <p>GoldenToys adalah platform terpercaya untuk jual beli mobil bekas berkualitas. Kami menghubungkan pembeli dan penjual dengan menyediakan informasi yang transparan dan akurat tentang setiap kendaraan.</p>
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
                <p>&copy;<script>document.write(new Date().getFullYear());</script> GoldenToys - All rights reserved</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function removeItem(id) {
            if (confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
                fetch('/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal menghapus produk dari keranjang.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert('Produk berhasil dihapus!');
                        location.reload();
                    } else {
                        alert(data.message || 'Terjadi kesalahan saat menghapus produk.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                });
            }
        }

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