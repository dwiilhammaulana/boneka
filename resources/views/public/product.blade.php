<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="GoldenToys - Jual Beli Mobil Bekas">
    <meta name="keywords" content="mobil, bekas, jual, beli, otomotif">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GoldenToys - {{ $product->product_name ?? 'Detail Produk' }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Balsamiq+Sans:wght@400;700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    .first-letter {
        color: var(--dark-yellow);
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

    /* ===== PRODUCT PAGE STYLES ===== */
    .product-page {
        padding: 80px 0;
        background-color: var(--white);
    }

    .product-slider .owl-stage-outer {
        border-radius: 25px;
        overflow: hidden;
        border: 3px solid var(--blue);
        box-shadow: 0 10px 30px rgba(125, 211, 252, 0.3);
    }

    .product-img {
        background-color: var(--light-bg);
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
    }

    .product-img img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .product-slider .owl-item.active .product-img img {
        transform: scale(1.05);
    }

    .p-status {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, var(--yellow), var(--orange));
        color: #4A5568;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        font-family: 'Comic Neue', cursive;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .product-content {
        padding: 20px 0 20px 40px;
    }

    .product-content h2 {
        color: var(--dark-yellow);
        font-weight: 700;
        font-size: 2.5rem;
        font-family: 'Comic Neue', cursive;
        margin-bottom: 20px;
        text-shadow: 2px 2px 0px var(--yellow);
    }

    .pc-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
        padding: 20px;
        background: var(--light-bg);
        border-radius: 20px;
        border: 2px solid var(--blue);
    }

    .pc-meta h5 {
        color: var(--dark-yellow);
        font-weight: 700;
        font-size: 2rem;
        margin: 0;
        font-family: 'Comic Neue', cursive;
    }

    .rating {
        color: var(--yellow);
        font-size: 1.2rem;
    }

    .rating i {
        margin: 0 2px;
    }

    .product-content p {
        color: #6B7280;
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 30px;
        padding: 20px;
        background: var(--light-bg);
        border-radius: 15px;
        border-left: 4px solid var(--yellow);
    }

    .tags {
        list-style: none;
        padding: 0;
        margin-bottom: 30px;
    }

    .tags li {
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        padding: 12px 20px;
        background: var(--light-bg);
        border-radius: 15px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .tags li:hover {
        border-color: var(--yellow);
        transform: translateX(10px);
    }

    .tags li span {
        font-weight: 600;
        color: var(--dark-yellow);
        min-width: 120px;
        font-family: 'Comic Neue', cursive;
    }

    .btn-keranjang {
        background: linear-gradient(135deg, var(--yellow), var(--orange));
        color: #4A5568;
        border: none;
        padding: 15px 35px;
        border-radius: 15px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(253, 224, 71, 0.4);
        flex: 1;
    }

    .btn-keranjang:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(253, 224, 71, 0.6);
        background: linear-gradient(135deg, var(--orange), var(--yellow));
    }

    .btn-outline-dark {
        border: 2px solid #4A5568;
        color: #4A5568;
        padding: 15px 35px;
        border-radius: 15px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        flex: 1;
        text-decoration: none;
        text-align: center;
    }

    .btn-outline-dark:hover {
        background-color: #4A5568;
        color: var(--white);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(74, 85, 104, 0.3);
    }

    /* ===== PRODUCT SPECS STYLES ===== */
    .product-specs {
        background-color: var(--light-bg);
        padding: 80px 0;
    }

    .section-title h2 {
        color: var(--dark-yellow);
        font-weight: 700;
        font-size: 2.5rem;
        font-family: 'Comic Neue', cursive;
        margin-bottom: 40px;
        text-align: center;
    }

    .product-specs-details {
        background: var(--white);
        border-radius: 25px;
        padding: 40px;
        border: 3px solid var(--blue);
    }

    .spec-item {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .spec-item:last-child {
        border-bottom: none;
    }

    .spec-title {
        font-weight: 600;
        color: var(--dark-yellow);
        min-width: 200px;
    }

    .spec-value {
        color: #4A5568;
    }

    /* ===== RELATED PRODUCTS STYLES ===== */
    .card-hover {
        transition: all 0.3s ease;
        border: 3px solid var(--blue);
        border-radius: 25px;
        overflow: hidden;
    }

    .card-hover:hover {
        transform: translateY(-10px);
        border-color: var(--yellow);
        box-shadow: 0 15px 30px rgba(253, 224, 71, 0.2);
    }

    .card-title {
        color: var(--dark-yellow);
        font-weight: 700;
        font-family: 'Comic Neue', cursive;
    }

    .text-danger {
        color: var(--orange) !important;
        font-weight: 700;
    }

    /* ===== FOOTER STYLES ===== */
    .footer-section {
        background-color: var(--purple);
        color: var(--white);
        padding: 60px 0 0;
    }

    .single-footer-widget h4 {
        color: var(--yellow);
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
        color: var(--white);
    }

    .single-footer-widget ul li:hover {
        color: var(--yellow);
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
        color: var(--purple);
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
        
        .logo-text {
            font-size: 24px;
        }
        
        .product-content {
            padding: 20px 0;
            margin-top: 30px;
        }
        
        .product-content h2 {
            font-size: 2rem;
        }
        
        .pc-meta {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }
        
        .pc-meta h5 {
            font-size: 1.7rem;
        }
        
        .tags li {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
        
        .tags li span {
            min-width: auto;
        }
        
        .d-flex.gap-3 {
            flex-direction: column;
        }
        
        .btn-keranjang,
        .btn-outline-dark {
            width: 100%;
        }
        
        .spec-item {
            flex-direction: column;
        }
        
        .spec-title {
            min-width: auto;
            margin-bottom: 5px;
        }
    }
</style>
</head>

<body>
    <!-- Page Preloader -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section -->
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
                    <li><a class="active" href="{{ route('public.shop') }}">Shop</a></li>
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

            <!-- User & Cart Icons - Right Side -->
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

    <!-- Product Page -->
    <section class="product-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-slider owl-carousel">
                        @foreach(range(1, 5) as $i)
                            @php
                                $field = $i === 1 ? 'image_url' : 'image_url' . $i;
                                $image = $product->$field ?? null;
                            @endphp
                            @if($image)
                                <div class="product-img">
                                    <figure>
                                        <img src="{{ asset('img/' . $image) }}" alt="{{ $product->product_name }}">
                                        @if($i === 1 && $product->is_new)
                                            <div class="p-status">Baru</div>
                                        @endif
                                    </figure>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-content">
                        <h2>{{ $product->product_name }}</h2>
                        <div class="pc-meta">
                            <h5>Rp{{ number_format($product->price, 0, ',', '.') }}</h5>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p>{{ $product->description }}</p>
                        <ul class="tags">
                            <li><span>Merek :</span> {{ $product->category->category_name ?? 'Tidak ada' }}</li>
                            <li><span>Warna :</span> {{ $product->warna ?? 'Tidak ada' }}</li>
                            <li><span>Tahun :</span> {{ $product->tahun ?? 'Tidak ada' }}</li>
                            <li><span>Kilometer :</span> {{ $product->kilometer ?? 'Tidak ada' }} km</li>
                        </ul>

                        <form id="addToCartForm" action="{{ route('public.cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                            <div class="d-flex gap-3 mt-3">
                                <button type="button" class="btn btn-keranjang" id="btnKeranjang">
                                    Masukan Keranjang
                                </button>

                                <a href="{{ route('checkout') }}" class="btn btn-outline-dark">
                                    Beli Sekarang
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Spesifikasi Produk -->
    <section class="product-specs spad">
        <div class="container">
            <div class="section-title">
                <h2>Spesifikasi</h2>
            </div>
            <div class="product-specs-details">
                <div class="spec-item">
                    <div class="spec-title">Nama Produk</div>
                    <div class="spec-value">{{ $product->product_name }}</div>
                </div>
                <div class="spec-item">
                    <div class="spec-title">Kategori</div>
                    <div class="spec-value">{{ $product->category->category_name ?? 'Tidak ada' }}</div>
                </div>
                <div class="spec-item">
                    <div class="spec-title">Warna</div>
                    <div class="spec-value">{{ $product->warna ?? 'Tidak ada' }}</div>
                </div>
                <div class="spec-item">
                    <div class="spec-title">Tahun</div>
                    <div class="spec-value">{{ $product->tahun ?? 'Tidak ada' }}</div>
                </div>
                <div class="spec-item">
                    <div class="spec-title">Kilometer</div>
                    <div class="spec-value">{{ $product->kilometer ?? 'Tidak ada' }} km</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="py-5">
        <div class="container">
            <div class="section-title">
                <h2>Produk Terkait</h2>
            </div>
            <div class="row">
                @forelse ($relatedProducts as $relatedProduct)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <a href="{{ route('product.detail', ['id' => $relatedProduct->product_id]) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 border-0 shadow-sm card-hover">
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <img 
                                        src="{{ asset('img/' . $relatedProduct->image_url) }}" 
                                        alt="{{ $relatedProduct->product_name }}"
                                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-semibold">{{ $relatedProduct->product_name }}</h5>
                                    <p class="text-muted mb-1">
                                        {{ $relatedProduct->brand ?? 'Brand Tidak Ada' }} &middot;
                                        {{ $relatedProduct->tahun ?? 'Tahun Tidak Ada' }}
                                    </p>
                                    <h6 class="text-danger fw-bold">
                                        Rp{{ number_format($relatedProduct->price, 0, ',', '.') }}
                                    </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Tidak ada produk terkait.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section spad">
        <div class="container">
            <div class="footer-widget">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-footer-widget">
                            <h4>Tentang Kami</h4>
                            <ul>
                                <li>Tentang Kami</li>
                                <li>Komunitas</li>
                                <li>Karir</li>
                                <li>Pengiriman</li>
                                <li>Kontak Kami</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-footer-widget">
                            <h4>Layanan Pelanggan</h4>
                            <ul>
                                <li>Pencarian</li>
                                <li>Kebijakan Privasi</li>
                                <li>Katalog 2023</li>
                                <li>Pengiriman & Pengantaran</li>
                                <li>Galeri</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-footer-widget">
                            <h4>Layanan Kami</h4>
                            <ul>
                                <li>Gratis Pengiriman</li>
                                <li>Gratis Pengembalian</li>
                                <li>Franchise Kami</li>
                                <li>Syarat dan Ketentuan</li>
                                <li>Kebijakan Privasi</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-footer-widget">
                            <h4>Informasi</h4>
                            <ul>
                                <li>Metode Pembayaran</li>
                                <li>Waktu dan biaya pengiriman</li>
                                <li>Pengembalian Produk</li>
                                <li>Metode Pengiriman</li>
                                <li>Kesesuaian Produk</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="social-links-warp">
            <div class="container">
                <div class="social-links">
                    <a href="#" class="instagram"><i class="fab fa-instagram"></i><span>instagram</span></a>
                    <a href="#" class="pinterest"><i class="fab fa-pinterest"></i><span>pinterest</span></a>
                    <a href="#" class="facebook"><i class="fab fa-facebook"></i><span>facebook</span></a>
                    <a href="#" class="twitter"><i class="fab fa-twitter"></i><span>twitter</span></a>
                    <a href="#" class="youtube"><i class="fab fa-youtube"></i><span>youtube</span></a>
                    <a href="#" class="tiktok"><i class="fab fa-tiktok"></i><span>tiktok</span></a>
                </div>
            </div>
            <div class="container text-center pt-5">
                <p>&copy;<script>document.write(new Date().getFullYear());</script> GoldenToys - All rights reserved</p>
            </div>
        </div>
    </footer>

    <!-- JS Plugins -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('ecomerce/js/owl.carousel.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            // Product Slider
            $(".product-slider").owlCarousel({
                items: 1,
                loop: true,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 5000,
                smartSpeed: 1000
            });

            // Add to Cart
            $('#btnKeranjang').on('click', function () {
                $.ajax({
                    type: 'POST',
                    url: $('#addToCartForm').attr('action'),
                    data: $('#addToCartForm').serialize(),
                    success: function (response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Produk telah dimasukkan ke keranjang.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan. Silakan coba lagi.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Preloader
            $(window).on('load', function () {
                $("#preloder").delay(600).fadeOut("slow");
            });
        });
    </script>
</body>
</html>