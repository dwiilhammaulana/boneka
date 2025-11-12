@if(session('success'))
    <div class="alert alert-success alert-custom">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
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
    <title>GoldenToys - Edit Profile</title>

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
        --accent: #F59E0B;
        --white: #FFFFFF;
        --light-bg: #FFFBEB;
        --dark-yellow: #F59E0B;
        --orange: #FB923C;
        --green: #4ADE80;
        --purple: #A78BFA;


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
        color: var(--secondary);
        text-decoration: none;
        font-family: 'Comic Neue', cursive;
        text-shadow: 2px 2px 0px var(--primary);
        transition: all 0.3s ease;
    }

    .logo-text:hover {
        color: var(--orange);
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
        background-color: var(--secondary);
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
        color: #4A5568 !important;
        transition: all 0.3s ease;
        border-radius: 0;
        text-decoration: none;
        border-bottom: 1px solid #f0f0f0;
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
        background-color: var(--dark-yellow);
        transform: scale(1.1);
    }

    .header-right i {
        color: var(--white);
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
        background-color: var(--secondary);
        border-bottom: 2px solid var(--primary);
        padding: 15px 0;
    }

    .header-item {
        background: var(--white);
        border-radius: 20px;
        padding: 20px;
        border: 3px solid var(--accent);
        transition: all 0.3s ease;
        text-align: center;
        height: 100%;
    }

    .header-item:hover {
        transform: translateY(-5px);
        border-color: var(--primary);
        box-shadow: 0 10px 25px rgba(245, 158, 11, 0.2);
    }

    .header-item img {
        height: 50px;
        margin-bottom: 10px;
        filter: hue-rotate(45deg);
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

    /* ===== PAGE HEADER STYLES ===== */
    .page-add {
        background: linear-gradient(135deg, var(--accent), var(--primary)) !important;
        color: var(--white);
        padding: 60px 0;
    }

    .page-breadcrumb h2 {
        color: var(--white) !important;
        font-weight: 700;
        font-size: 2.5rem;
        font-family: 'Comic Neue', cursive;
        text-shadow: 2px 2px 0px rgba(0,0,0,0.2);
    }

    .page-breadcrumb h2 span {
        color: var(--secondary);
    }

    /* ===== FORM STYLES ===== */
    .contact-section {
        padding: 80px 0;
        background-color: var(--white);
    }

    .edit-customer-form {
        background: var(--white);
        border: 3px solid var(--accent);
        border-radius: 25px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(125, 211, 252, 0.2);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        font-weight: 600;
        color: var(--dark-yellow);
        margin-bottom: 8px;
        font-family: 'Comic Neue', cursive;
    }

    .form-control {
        border: 2px solid var(--accent);
        border-radius: 15px;
        padding: 12px 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: var(--light-bg);
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.3rem rgba(245, 158, 11, 0.25);
        background-color: var(--white);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--dark-yellow));
        border: none;
        color: var(--white);
        padding: 12px 35px;
        border-radius: 15px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.6);
        background: linear-gradient(135deg, var(--dark-yellow), var(--primary));
    }

    .text-right {
        text-align: right;
    }

    h3.mb-4 {
        color: var(--dark-yellow);
        font-weight: 700;
        font-family: 'Comic Neue', cursive;
        text-shadow: 2px 2px 0px var(--secondary);
    }

    /* ===== FOOTER STYLES ===== */
    .footer-section {
        background-color: var(--purple);
        color: var(--white);
        padding: 60px 0 0;
    }

    .single-footer-widget h4 {
        color: var(--secondary);
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
        background: var(--secondary);
        transform: scale(1.2) rotate(10deg);
    }

    .social-links a:hover i {
        color: var(--primary);
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
        
        .edit-customer-form {
            padding: 25px;
        }
        
        .text-right {
            text-align: center;
        }
        
        .btn-primary {
            width: 100%;
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
                                    <li><a class="active" href="{{ route('customer.profile') }}">{{ Auth::guard('customer')->user()->username }}</a></li>
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

    <!-- Page Header -->
    <section class="page-add">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="page-breadcrumb">
                        <h2>Edit Profile<span>.</span></h2>
                        <p class="text-white mt-3">Perbarui informasi profil Anda dengan data yang terbaru</p>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-user-edit fa-5x text-white opacity-75"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <div class="contact-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h3 class="mb-4 text-center">Edit Profile Customer</h3>
                    <form action="{{ route('customers.update', $customer->customer_id) }}" method="POST" class="edit-customer-form">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="username">
                                <i class="fas fa-user me-2"></i>Username
                            </label>
                            <input type="text" id="username" name="username" value="{{ old('username', $customer->username) }}" class="form-control" placeholder="Masukkan username" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope me-2"></i>E-mail
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}" class="form-control" placeholder="Masukkan alamat email">
                        </div>
                        
                        <div class="form-group">
                            <label for="full_name">
                                <i class="fas fa-id-card me-2"></i>Full Name
                            </label>
                            <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $customer->full_name) }}" class="form-control" placeholder="Masukkan nama lengkap" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone_number">
                                <i class="fas fa-phone me-2"></i>Phone Number
                            </label>
                            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $customer->phone_number) }}" class="form-control" placeholder="Masukkan nomor telepon">
                        </div>
                        
                        <div class="form-group">
                            <label for="address">
                                <i class="fas fa-map-marker-alt me-2"></i>Address
                            </label>
                            <textarea id="address" name="address" class="form-control" rows="4" placeholder="Masukkan alamat lengkap">{{ old('address', $customer->address) }}</textarea>
                        </div>
                        
                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="footer-section spad">
        <div class="container">
            <div class="footer-widget">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="single-footer-widget">
                            <h4>Tentang GoldenToys</h4>
                            <p>GoldenToys adalah platform terpercaya untuk jual beli mobil bekas berkualitas. Kami menghubungkan pembeli dan penjual dengan menyediakan informasi yang transparan dan akurat tentang setiap kendaraan. Setiap mobil yang terdaftar di platform kami telah melalui proses verifikasi untuk memastikan kualitas dan keasliannya.</p>
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

        // Form validation enhancement
        document.querySelector('.edit-customer-form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            if (password && password.length < 6) {
                e.preventDefault();
                alert('Password harus minimal 6 karakter!');
                return false;
            }
        });
    </script>
</body>
</html>