<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Toko Boneka Ceria">
    <meta name="keywords" content="Boneka, mainan, lucu, koleksi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GoldenToys - Toko Boneka Impian</title>

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


    /* ===== CONTACT SECTION ===== */
    .contact-section {
        background-color: var(--white);
        padding: 80px 0;
    }

    .page-add {
        background: linear-gradient(135deg, var(--yellow), var(--orange));
        padding: 60px 0;
        margin-bottom: 0;
    }

    .page-breadcrumb h2 {
        color: var(--white);
        font-size: 3rem;
        font-weight: 700;
        font-family: 'Comic Neue', cursive;
        text-shadow: 2px 2px 0px var(--dark-yellow);
    }

    .page-breadcrumb h2 span {
        color: var(--purple);
    }

    /* Contact Form */
    .contact-form {
        background: var(--white);
        border-radius: 25px;
        padding: 40px;
        border: 4px solid var(--blue);
        box-shadow: 0 15px 35px rgba(125, 211, 252, 0.2);
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        padding: 15px 20px;
        border: 3px solid var(--yellow);
        border-radius: 15px;
        margin-bottom: 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--light-bg);
        font-family: 'Quicksand', sans-serif;
    }

    .contact-form input:focus,
    .contact-form textarea:focus {
        border-color: var(--purple);
        box-shadow: 0 0 0 0.3rem rgba(167, 139, 250, 0.25);
        outline: none;
    }

    .contact-form textarea {
        height: 150px;
        resize: vertical;
    }

    .contact-form button {
        background-color: var(--yellow);
        color: #4A5568;
        border: none;
        padding: 15px 40px;
        border-radius: 15px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        font-family: 'Comic Neue', cursive;
    }

    .contact-form button:hover {
        background-color: var(--dark-yellow);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 10px 20px rgba(245, 158, 11, 0.4);
        color: var(--white);
    }

    /* Contact Widget */
    .contact-widget {
        background: var(--white);
        border-radius: 25px;
        padding: 30px;
        border: 4px solid var(--green);
        box-shadow: 0 15px 35px rgba(74, 222, 128, 0.2);
    }

    .cw-item {
        margin-bottom: 30px;
    }

    .cw-item:last-child {
        margin-bottom: 0;
    }

    .cw-item h5 {
        color: var(--dark-yellow);
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 15px;
        font-family: 'Comic Neue', cursive;
    }

    .cw-item ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .cw-item ul li {
        color: #4A5568;
        font-weight: 500;
        padding: 5px 0;
        font-size: 1rem;
    }

    /* Map */
    .map {
        margin-top: 60px;
        border-radius: 25px;
        overflow: hidden;
        border: 4px solid var(--purple);
        box-shadow: 0 15px 35px rgba(167, 139, 250, 0.3);
    }

    .map iframe {
        width: 100%;
        border: none;
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

    .single-footer-widget p {
        color: var(--white);
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

    /* ===== ALERT STYLES ===== */
    .alert {
        padding: 15px 20px;
        border-radius: 15px;
        margin-bottom: 20px;
        border: 3px solid transparent;
        font-weight: 600;
    }

    .alert-success {
        background-color: var(--green);
        color: var(--white);
        border-color: var(--dark-yellow);
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
        
        .page-breadcrumb h2 {
            font-size: 2rem;
        }
        
        .contact-form {
            padding: 20px;
        }
        
        .contact-widget {
            margin-top: 30px;
        }
        
        .header-item {
            margin-bottom: 15px;
        }
        
        .header-right {
            margin-left: 0;
        }
    }

    @media (max-width: 576px) {
        .header-right {
            gap: 10px;
        }
        
        .cart-icon, .login-icon {
            width: 35px;
            height: 35px;
        }
        
        .contact-form button {
            width: 100%;
        }
        
        .main-menu ul {
            gap: 5px;
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
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="container-fluid">
            <div class="inner-header">
                <div class="logo">
                    <a href="#" class="logo-text">
                        <span class="first-letter">G</span>oldenToys
                    </a>
                </div>

                <!-- Menu Navigasi -->
                <nav class="main-menu mobile-menu">
                    <ul>
                        <li><a href="{{ route('public.home') }}">Home</a></li>
                        <li><a href="{{ route('public.shop') }}">Shop</a></li>
                        <li><a class="active" href="#">Contact</a></li>
                        
                        <!-- Simulasi pengguna sudah login -->
                        <li>
                            <span>
                                <i class="fas fa-user-circle me-2"></i>
                                Profile
                            </span>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">
                                        <i class="fas fa-user me-2"></i>
                                        JohnDoe
                                    </a>
                                </li>
                                <li>
                                    <form action="#" method="POST">
                                        <button type="submit" class="logout-btn">
                                            <i class="fas fa-sign-out-alt me-2"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{ route('public.pesanan') }}">Pesanan</a></li>
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
                        <i class="fas fa-shipping-fast"></i>
                        <p>Free shipping on orders over $30 in USA</p>
                    </div>
                </div>
                <div class="col-md-4 text-left text-lg-center">
                    <div class="header-item">
                        <i class="fas fa-tag"></i>
                        <p>20% Student Discount</p>
                    </div>
                </div>
                <div class="col-md-4 text-left text-xl-right">
                    <div class="header-item">
                        <i class="fas fa-percentage"></i>
                        <p>30% off on dresses. Use code: 30OFF</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Info End -->
    <!-- Header End -->

    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="page-breadcrumb">
                        <h2>Contact us<span>.</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- Contact Section Begin -->
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <form action="#" method="POST" class="contact-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="first_name" placeholder="First Name" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="last_name" placeholder="Last Name" required>
                            </div>
                            <div class="col-lg-12">
                                <input type="email" name="email" placeholder="E-mail" required>
                                <input type="text" name="subject" placeholder="Subject">
                                <textarea name="message" placeholder="Message" required></textarea>
                            </div>
                            <div class="col-lg-12 text-right">
                                <button type="submit">Send message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="contact-widget">
                        <div class="cw-item">
                            <h5><i class="fas fa-map-marker-alt me-2"></i>Location</h5>
                            <ul>
                                <li>Jl. BSD Raya Utama,</li>
                                <li>Tangerang, Banten, Indonesia</li>
                            </ul>
                        </div>
                        <div class="cw-item">
                            <h5><i class="fas fa-phone me-2"></i>Phone</h5>
                            <ul>
                                <li>+62 896 8611 5596</li>
                            </ul>
                        </div>
                        <div class="cw-item">
                            <h5><i class="fas fa-envelope me-2"></i>E-mail</h5>
                            <ul>
                                <li>contact@tangerangstore.com</li>
                                <li>www.tangerangstore.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="map">
                <div class="row">
                    <div class="col-lg-12">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1983.6267762467358!2d106.63188811624652!3d-6.304856699999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e42022d9c308a45%3A0x95cb080f1dba33f8!2sBSD%20City!5e0!3m2!1sen!2sid!4v1693293219108!5m2!1sen!2sid"
                            height="560" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-widget">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="single-footer-widget">
                            <h4>Cerita tentang GoldenToys</h4>
                            <p>GoldenToys bukan hanya sebuah toko mainan, tetapi juga tempat dimana imajinasi dan kreativitas bertemu. Setiap mainan yang kami pilih memiliki cerita dan nilai edukatif yang dapat membantu perkembangan anak. Kami percaya bahwa bermain adalah bagian penting dari proses belajar dan tumbuh kembang setiap anak.</p>
                            <p>Dengan komitmen terhadap kualitas dan keamanan, kami menghadirkan mainan-mainan terbaik yang tidak hanya menyenangkan tetapi juga aman untuk buah hati Anda. Melalui inovasi dan perhatian terhadap detail, kami terus berupaya menghadirkan pengalaman berbelanja yang menyenangkan bagi seluruh keluarga.</p>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="social-links-warp">
            <div class="container text-center">
                <div class="social-links">
                    <a href="#" class="instagram">
                        <i class="fab fa-instagram"></i>
                        <span>Instagram</span>
                    </a>
                    <a href="#" class="facebook">
                        <i class="fab fa-facebook-f"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="#" class="twitter">
                        <i class="fab fa-twitter"></i>
                        <span>Twitter</span>
                    </a>
                    <a href="#" class="youtube">
                        <i class="fab fa-youtube"></i>
                        <span>YouTube</span>
                    </a>
                </div>
            </div>
            <div class="container text-center pt-3">
                <p>&copy;<script>document.write(new Date().getFullYear());</script> Hak Cipta Dilindungi | Dibuat dengan <i class="fas fa-heart" style="color: #dc3545;"></i> oleh GoldenToys Team</p>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Loading preloader
        $(document).ready(function() {
            $("#preloder").delay(1000).fadeOut(500);
        });
    </script>
</body>
</html>