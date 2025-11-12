<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="MobilShift - Jual Beli Mobil Bekas">
    <meta name="keywords" content="mobil, bekas, jual, beli, otomotif">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GoldenToys - Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Balsamiq+Sans:wght@400;700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">

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

    /* ===== PRODUCT SECTION ===== */
    .latest-products {
        background-color: var(--light-bg);
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
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-15px) scale(1.05);
        border-color: var(--yellow);
        box-shadow: 0 25px 50px rgba(253, 224, 71, 0.3);
    }

    .product-image-container {
        background: var(--light-bg);
        height: 200px;
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

    .divider {
        height: 2px;
        background: linear-gradient(to right, transparent, var(--yellow), transparent);
        margin: 0 20px;
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        color: var(--dark-yellow);
        font-weight: 700;
        font-size: 1.3rem;
        font-family: 'Comic Neue', cursive;
        margin-bottom: 10px;
    }

    .text-danger {
        color: var(--orange) !important;
        font-weight: 700;
        font-size: 1.4rem;
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
        font-size: 2rem;
        font-family: 'Comic Neue', cursive;
        margin-bottom: 20px;
    }

    .single-footer-widget p {
        font-size: 1rem;
        line-height: 1.8;
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
        
        .header-item {
            margin-bottom: 15px;
        }
        
        .header-right {
            margin-left: 0;
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

    <!-- Header Info -->

    <!-- Produk Terbaru -->
    <section class="latest-products spad">
        <div class="container py-5">
            <div class="product-filter mb-4">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-title">
                            <h2>Mobil Bekas Terbaik</h2>
                            <p>Temukan mobil bekas berkualitas dengan harga terbaik</p>
                        </div>
                        <ul class="product-controls">
                            <li class="active" data-filter="*">Semua</li>
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
                        <div class="product-card">
                            <a href="{{ route('product.detail', ['id' => $product->product_id]) }}" class="text-decoration-none">
                                <div class="product-image-container">
                                    <img src="{{ asset('img/' . $product->image_url) }}" alt="{{ $product->product_name }}">
                                </div>
                            </a>
                            <div class="divider"></div>
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $product->product_name }}</h5>
                                <p class="text-muted mb-1">
                                    {{ ucfirst($product->brand ?? 'Brand Tidak Ada') }} • 
                                    {{ $product->year ?? 'Tahun Tidak Ada' }}
                                </p>
                                <p class="text-danger">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer-section spad">
        <div class="container">
            <div class="footer-widget">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="single-footer-widget">
                            <h4>Tentang GoldenToys</h4>
                            <p>GoldenToys adalah platform terpercaya untuk jual beli mobil bekas berkualitas. Kami menghubungkan pembeli dan penjual dengan menyediakan informasi yang transparan dan akurat tentang setiap kendaraan. Setiap mobil yang terdaftar di platform kami telah melalui proses verifikasi untuk memastikan kualitas dan keasliannya.</p>
                            <p>Dengan komitmen untuk memberikan pengalaman terbaik dalam berbelanja mobil bekas, kami terus berinovasi dalam menyajikan informasi yang lengkap dan membantu Anda menemukan mobil impian dengan harga yang terjangkau. Kepercayaan dan kepuasan pelanggan adalah prioritas utama kami.</p>
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

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('ecomerce/js/mixitup.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            // Preloader
            $(window).on('load', function () {
                $("#preloder").delay(600).fadeOut("slow");
            });

            // Product Filter
            var mixer = mixitup('#product-list', {
                selectors: {
                    target: '.mix'
                },
                animation: {
                    duration: 300,
                    effects: 'fade scale(0.7)',
                    easing: 'cubic-bezier(0.645, 0.045, 0.355, 1)'
                }
            });

            // Active class for filter buttons
            $('.product-controls li').on('click', function() {
                $('.product-controls li').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
</body>
</html>