<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Toko Boneka Ceria">
    <meta name="keywords" content="Boneka, mainan, lucu, koleksi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DollCraft - Toko Boneka Impian</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Comic+Neue:wght@400;700&family=Balsamiq+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    :root {
        --purple: #A78BFA;
        --blue: #7DD3FC;
        --yellow: #FDE047;
        --white: #FFFFFF;
        --light-bg: #FFFDF0;
        --orange: #FB923C;
        --green: #4ADE80;
        --dark-yellow: #F59E0B;
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
        border-bottom: 2px solid var(--yellow);
        box-shadow: 0 2px 10px rgba(253, 224, 71, 0.1);
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
        color: var(--dark-yellow);
        text-decoration: none;
        font-family: 'Comic Neue', cursive;
        text-shadow: 2px 2px 0px var(--yellow);
        transition: all 0.3s ease;
    }

    .logo-text:hover {
        color: var(--purple);
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

    /* User Menu */
    .user-menu {
        position: relative;
    }

    .user-greeting {
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, var(--yellow), var(--orange));
        color: #4A5568;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .user-greeting:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .user-greeting i.fa-user-circle {
        font-size: 1.1rem;
    }

    .dropdown-arrow {
        font-size: 0.8rem;
        transition: transform 0.3s ease;
    }

    .user-menu:hover .dropdown-arrow {
        transform: rotate(180deg);
    }

    /* User Dropdown */
    .user-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
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
        margin-top: 10px;
    }

    .user-menu:hover .user-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .user-dropdown li {
        list-style: none;
    }

    .user-dropdown li a {
        display: block;
        padding: 12px 20px;
        color: #4A5568;
        text-decoration: none;
        transition: all 0.3s ease;
        border-bottom: 1px solid #f0f0f0;
    }

    .user-dropdown li a:hover {
        background-color: var(--yellow);
        color: #4A5568;
        padding-left: 25px;
    }

    .user-dropdown li a i {
        width: 16px;
        text-align: center;
    }

    /* Logout Button */
    .logout-btn {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        padding: 12px 20px;
        color: #dc3545;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .logout-btn:hover {
        background-color: #dc3545;
        color: var(--white);
        padding-left: 25px;
    }

    .dropdown-divider {
        height: 1px;
        background: #dee2e6;
        margin: 5px 0;
    }

    /* Header Info */
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

    /* ===== HERO SLIDER ===== */
    .hero-slider {
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .hero-items {
        width: 100%;
    }

    .hero-items .single-slider-item {
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        width: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    /* pastikan Owl tidak menampilkan img default */
    .owl-carousel .owl-item img {
        display: none !important;
    }

    .hero-items .owl-stage-outer {
        overflow: hidden;
        width: 100% !important;
    }

    .hero-items .owl-stage {
        display: flex;
        width: 100% !important;
    }

    .hero-items .owl-item {
        width: 100% !important;
        flex-shrink: 0;
    }

    .single-slider-item {
        width: 100%;
        min-height: 100vh;
        text-align: center;
        position: relative;
        overflow: hidden;
        flex: 0 0 100%;
        padding: 0;
    }

    /* teks utama di tengah */
    .single-slider-item h1 {
        color: #fff;
        font-weight: 700;
        font-size: clamp(2rem, 8vw, 4rem);
        font-family: 'Comic Neue', cursive;
        text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.6);
        margin-bottom: 1rem;
    }

    /* subjudul */
    .single-slider-item h2 {
        color: #fff;
        font-size: clamp(1.5rem, 5vw, 2.5rem);
        font-family: 'Balsamiq Sans', cursive;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    /* transisi antar slide lebih halus */
    .owl-carousel .owl-item.active .single-slider-item {
        animation: fadeSlide 1s ease-in-out;
    }

    @keyframes fadeSlide {
        from {
            opacity: 0;
            transform: scale(1.05);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* ===== FEATURES SECTION ===== */
    .features-section {
        background-color: var(--yellow);
        padding: 80px 0;
    }

    .single-features-ads {
        background: var(--white);
        border-radius: 25px;
        padding: 40px 30px;
        border: 4px solid var(--blue);
        transition: all 0.3s ease;
        text-align: center;
        height: 100%;
    }

    .single-features-ads:hover {
        transform: translateY(-10px) scale(1.02);
        border-color: var(--purple);
        box-shadow: 0 20px 40px rgba(167, 139, 250, 0.3);
    }

    .single-features-ads.first {
        border-color: var(--green);
    }

    .single-features-ads.second {
        border-color: var(--orange);
    }

    .single-features-ads h4 {
        color: var(--dark-yellow);
        font-weight: 700;
        font-size: 1.5rem;
        margin: 20px 0 15px;
        font-family: 'Comic Neue', cursive;
    }

    .single-features-ads i {
        font-size: 3rem;
        color: var(--dark-yellow);
    }

    /* ===== PRODUCT SECTION ===== */
    .latest-products {
        background-color: var(--white);
        padding: 80px 0;
    }

    .section-title h2 {
        color: var(--dark-yellow);
        font-weight: 700;
        font-size: 3rem;
        font-family: 'Comic Neue', cursive;
        margin-bottom: 10px;
    }

    .section-title p {
        color: #6B7280;
        font-size: 1.2rem;
    }

    .product-controls {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 30px;
    }

    .product-controls li {
        background: var(--white);
        border: 3px solid var(--yellow);
        color: #4A5568;
        border-radius: 25px;
        padding: 12px 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        font-family: 'Balsamiq Sans', cursive;
        list-style: none;
    }

    .product-controls li:hover,
    .product-controls li.active {
        background: var(--yellow);
        color: #4A5568;
        border-color: var(--dark-yellow);
        transform: scale(1.1);
    }

    .product-card {
        background: var(--white);
        border: 3px solid var(--blue);
        border-radius: 25px;
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
        margin-bottom: 30px;
    }

    .product-card:hover {
        transform: translateY(-15px) scale(1.05);
        border-color: var(--yellow);
        box-shadow: 0 25px 50px rgba(253, 224, 71, 0.3);
    }

    .product-image-container {
        background: var(--light-bg);
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .product-image-container img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image-container img {
        transform: scale(1.1);
    }

    .card-title {
        color: var(--dark-yellow);
        font-weight: 700;
        font-size: 1.3rem;
        font-family: 'Comic Neue', cursive;
    }

    .text-danger {
        color: var(--orange) !important;
        font-weight: 700;
        font-size: 1.4rem;
    }

    /* ===== FORM SECTION ===== */
    .product-form-section {
        background-color: var(--light-bg);
        padding: 80px 0;
    }

    .card-header.bg-primary {
        background-color: var(--yellow) !important;
        border-bottom: 4px solid var(--dark-yellow);
        color: #4A5568;
    }

    .btn-primary {
        background-color: var(--yellow);
        border: none;
        color: #4A5568;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 15px 30px;
        border-radius: 15px;
        font-size: 1.1rem;
    }

    .btn-primary:hover {
        background-color: var(--dark-yellow);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 10px 20px rgba(245, 158, 11, 0.4);
        color: var(--white);
    }

    .btn-secondary {
        background-color: var(--blue);
        border: none;
        color: var(--white);
        transition: all 0.3s ease;
        padding: 15px 30px;
        border-radius: 15px;
        font-size: 1.1rem;
    }

    .btn-secondary:hover {
        background-color: var(--purple);
        transform: translateY(-3px);
    }

    .form-control:focus {
        border-color: var(--yellow);
        box-shadow: 0 0 0 0.3rem rgba(253, 224, 71, 0.25);
    }

    /* ===== FOOTER ===== */
    .footer-section {
        background-color: var(--purple);
        color: var(--white);
        padding: 60px 0 0;
    }

    .single-footer-widget h4 {
        color: var(--yellow);
        font-weight: 700;
        font-size: 2rem;
        font-family: 'Comic Neue', cursive;
        margin-bottom: 20px;
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
    }

    .social-links a i {
        color: var(--dark-yellow);
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        background: var(--yellow);
        transform: scale(1.2) rotate(10deg);
    }

    .social-links a:hover i {
        color: var(--purple);
        transform: scale(1.2);
    }

    /* ===== USER WELCOME DISPLAY ===== */
    .user-welcome {
        margin-left: 20px;
    }

    .user-display {
        background: linear-gradient(135deg, var(--yellow), var(--orange));
        color: #4A5568;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .user-display i {
        font-size: 1rem;
    }

    /* Card User Info dalam Dropdown */
    .card.bg-primary {
        background: linear-gradient(135deg, var(--blue), var(--purple)) !important;
        border: none;
    }

    .card.bg-primary .card-title {
        font-size: 0.9rem;
        font-weight: 600;
    }

    .card.bg-primary small {
        font-size: 0.75rem;
    }

    /* User Meta Info */
    .user-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 5px;
        font-size: 0.75rem;
        opacity: 0.9;
    }

    .user-meta i {
        margin-right: 5px;
        font-size: 0.7rem;
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
        
        .user-greeting {
            font-size: 0.8rem;
            padding: 6px 12px;
        }
        
        .logo-text {
            font-size: 24px;
        }
        
        .single-slider-item h1 {
            font-size: 2.5rem;
        }
        
        .single-slider-item h2 {
            font-size: 1.8rem;
        }
        
        .section-title h2 {
            font-size: 2rem;
        }
        
        .product-controls {
            gap: 5px;
        }
        
        .product-controls li {
            padding: 8px 15px;
            font-size: 0.9rem;
        }
        
        .user-info-header {
            margin-left: 10px;
        }
        
        .user-card {
            padding: 6px 12px;
        }
        
        .user-avatar {
            width: 30px;
            height: 30px;
            font-size: 0.8rem;
        }
        
        .user-name {
            font-size: 0.8rem;
        }
        
        .user-role {
            font-size: 0.65rem;
        }
    }

</style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    
    <!-- Search model -->
    
    <!-- Search model end -->

    <!-- Header Section Begin -->
    <!-- Header Section Begin -->
<!-- Header Section Begin -->
<!-- Header Section Begin -->
<header class="header-section">
    <div class="container-fluid">
        <div class="inner-header">
<div class="logo-container">
        <img src="{{ asset('ecomerce/img/logo.png') }}" 
         alt="Golden Toys Logo" 
         style="width: 28px; height: 28px; vertical-align: middle;">
    <a href="{{ route('public.home') }}" class="logo-text">
        GoldenToys
    </a>
</div>

            <!-- Menu Navigasi -->
            <nav class="main-menu">
                <ul>
                    <li><a class="active" href="{{ route('public.home') }}">Home</a></li>
                    <li><a href="{{ route('public.shop') }}">Shop</a></li>
                    <li><a href="{{ route('public.contact') }}">Contact</a></li>
                    
                    @if(Auth::guard('customer')->check())
                        @php
                            $user = Auth::guard('customer')->user();
                        @endphp

                        <!-- User Menu -->
                        <li class="user-menu">
                            <div class="user-greeting">
                                <i class="fas fa-user-circle me-2"></i>
                                Hai, {{ $user->username }}
                                <i class="fas fa-chevron-down ms-2 dropdown-arrow"></i>
                            </div>
                            <ul class="user-dropdown">
                                <li><a href="{{ route('customer.profile') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><a href="{{ route('public.pesanan') }}"><i class="fas fa-box me-2"></i>Pesanan Saya</a></li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('customer.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="logout-btn">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @endif
                </ul>
            </nav>

            <div class="header-right">
                @auth('customer')
                    <a href="{{ route('public.cart') }}" class="cart-icon" style="position: relative;">
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
    <!-- Header Info Begin -->
    <div class="header-info">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="header-item">
                        <i class="fas fa-truck" style="color: var(--blue);"></i>
                        <p>Gratis ongkir untuk pembelian di atas Rp 300.000</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="header-item">
                        <i class="fas fa-graduation-cap" style="color: var(--green);"></i>
                        <p>Diskon 20% untuk Pelajar</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="header-item">
                        <i class="fas fa-gift" style="color: var(--pink);"></i>
                        <p>30% off boneka limited edition. Kode: DOLL30</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Info End -->

    <!-- Hero Slider Mulai -->
<section class="hero-slider">
    <div class="hero-items owl-carousel">
        <div class="single-slider-item" style="background-image: url('{{ asset('ecomerce/img/22.jpg') }}');"">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center text-white">
                        <h1>🎨 2025</h1>
                        <h2>Koleksi Boneka Eksklusif Terbaru!</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-slider-item" style="background-image: url('{{ asset('ecomerce/img/2.jpg') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center text-white">
                        <h1>🌟 2025</h1>
                        <h2>Boneka Berkualitas Premium</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-slider-item" style="background-image: url('{{ asset('ecomerce/img/3.jpg') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center text-white">
                        <h1>💫 2025</h1>
                        <h2>Toko Boneka No. 1 Indonesia</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Hero Slider Selesai -->

    <!-- Features Section Begin -->
    <section class="features-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-features-ads first">
                        <i class="fas fa-shipping-fast" style="color: var(--blue);"></i>
                        <h4>🚚 Pengiriman Cepat</h4>
                        <p>Boneka impian Anda akan sampai dengan cepat dan aman. Pengiriman ekspres tersedia untuk semua wilayah Indonesia!</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-features-ads second">
                        <i class="fas fa-shield-alt" style="color: var(--green);"></i>
                        <h4>🛡️ Garansi Kepuasan</h4>
                        <p>100% jaminan uang kembali jika tidak puas. Kami percaya pada kualitas setiap boneka yang kami jual.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-features-ads">
                        <i class="fas fa-headset" style="color: var(--pink);"></i>
                        <h4>💬 Support 24/7</h4>
                        <p>Tim kami siap membantu Anda kapan saja. Konsultasi pemilihan boneka atau bantuan lainnya dengan senang hati!</p>
                    </div>
                </div>
            </div>                
        </div>
    </section>
    <!-- Features Section End -->

    <!-- Produk Terbaru Mulai -->
        <!-- Produk Terbaru Mulai -->
    <section class="latest-products spad">
        <div class="container py-5">
            <div class="product-filter mb-4">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-title">
                            <h2>Boneka</h2>
                            <p>Temukan Boneka berkualitas dengan harga terbaik</p>
                        </div>
                        <ul class="product-controls">
                            <li data-filter="*">Semua</li>
                            @foreach($categories as $category)
                                <li data-filter=".{{ strtolower($category->category_name) }}">{{ $category->category_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row" id="product-list">
                @foreach($products->where('status', 'approved') as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 mix all {{ strtolower($product->category->category_name ?? 'lainnya') }}">
                        <div class="product-card card border rounded-4 shadow-sm mb-4 overflow-hidden bg-white transition">
                            <a href="{{ route('product.detail', ['id' => $product->product_id]) }}">
                                <div class="product-image-container">
                                    <img src="{{ asset('img/' . $product->image_url) }}" alt="{{ $product->product_name }}">
                                </div>
                            </a>
                            <div class="divider mx-3 my-2"></div>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold text-capitalize mb-1">{{ $product->product_name }}</h5>
                               
                                <p class="fw-bold text-danger mb-3">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <!-- CTA Button dengan redirect yang sama -->
                                <a href="{{ route('product.detail', ['id' => $product->product_id]) }}" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-eye me-2"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer Section Begin -->
    <footer class="footer-section spad">
        <div class="container">
            <div class="footer-widget">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="single-footer-widget">
                            <h4>✨ Cerita tentang DollCraft</h4>
                            <p>DollCraft adalah surga bagi para penggemar boneka! Kami hadir dengan misi menghadirkan kebahagiaan melalui koleksi boneka terbaik. Setiap boneka yang kami pilih memiliki cerita unik dan karakteristik khusus yang akan menemani hari-hari indah Anda.</p>
                            <p>Dari boneka binatang yang menggemaskan hingga karakter fantasi yang menakjubkan, kami memastikan setiap produk memenuhi standar kualitas tertinggi. Bahan-bahan premium, desain kreatif, dan perhatian terhadap detail adalah komitmen kami untuk memberikan pengalaman terbaik bagi para kolektor dan pecinta boneka.</p>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="social-links-warp">
            <div class="container text-center">
                <div class="social-links">
                    <a href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
                <p class="text-white mt-3 mb-0">
                    &copy; <script>document.write(new Date().getFullYear());</script> DollCraft - Toko Boneka Impian. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
<script>
$(document).ready(function(){
    $(".hero-items").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000, // 3 detik
        autoplayHoverPause: false,
        animateOut: 'fadeOut',
        dots: true,
        nav: false
    });
});
</script>

    <script>
        // Hide preloader when page loads
        $(window).on('load', function() {
            $('#preloder').fadeOut(1000);
        });

        // Initialize product filter
        $(document).ready(function () {
            var mixer = mixitup('#product-list', {
                selectors: {
                    target: '.mix'
                },
                animation: {
                    duration: 300
                }
            });

            // Add active class to filter buttons
            $('.product-controls li').click(function() {
                $('.product-controls li').removeClass('active');
                $(this).addClass('active');
            });

            // Simple slider functionality
            let currentSlide = 0;
            const slides = $('.single-slider-item');
            const totalSlides = slides.length;

            function showSlide(index) {
                slides.hide();
                slides.eq(index).show();
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            }

            // Initialize slider
            showSlide(currentSlide);
            setInterval(nextSlide, 4000);
        });
    </script>
</body>
</html>