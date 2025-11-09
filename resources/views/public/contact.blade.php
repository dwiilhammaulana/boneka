@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('berhasil'))
    <div class="alert alert-success">
        {{ session('berhasil') }}
    </div>
@endif


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MobilShift</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('ecomerce/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/style.css') }}" type="text/css">
        <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">
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
                    <div class="logo">
                        <a href="{{ route('public.home') }}" class="logo-text">
                            <span class="first-letter">M</span>obilShift
                        </a>
                        <style>
    .logo-text {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        text-decoration: none;
    }

    .logo-text:hover {
        color: #007bff;
    }

    .first-letter {
        color: red;
    }
</style>
                    </div>
                    </div>
                <div class="header-right">
                    <!-- Menampilkan icon profile untuk pengguna yang sudah login -->
                    @auth('customer')
                        <a href="{{ route('public.cart') }}">
                            <img src="{{ asset('ecomerce/img/icons/bag.png')}}" alt="">
                            <span>{{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}</span> <!-- Menampilkan jumlah barang di cart -->
                        </a>
                    @endauth

                    <!-- Menampilkan keranjang belanja untuk pengguna yang sudah login -->
                    @guest
                        <a href="{{ route('login') }}">
                            <img src="{{ asset('ecomerce/img/icons/user.png')}}" alt=""> <!-- Icon untuk login -->
                        </a>
                    @endguest
                </div>

                <!-- Menu Navigasi -->
                <nav class="main-menu mobile-menu" style="center">
                    <ul>
                        <li><a href="{{ route('public.home') }}">Home</a></li>
                        <li><a href="{{ route('public.shop') }}">Shop</a></li>
                        <li><a class="active" href="{{ route('public.contact') }}">Contact</a></li>
                        
                        @if(Auth::guard('customer')->check())
                            {{-- Pengguna sudah login --}}
                            <li><span>Profile</span>
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
                            {{-- Pengguna belum login --}}
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!-- Header Info Begin -->
    <div class="header-info">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="header-item">
                        <img src="{{ asset('ecomerce/img/icons/delivery.png') }}" alt="">
                        <p>Free shipping on orders over $30 in USA</p>
                    </div>
                </div>
                <div class="col-md-4 text-left text-lg-center">
                    <div class="header-item">
                        <img src="{{ asset('ecomerce/img/icons/voucher.png') }}" alt="">
                        <p>20% Student Discount</p>
                    </div>
                </div>
                <div class="col-md-4 text-left text-xl-right">
                    <div class="header-item">
                    <img src="{{ asset('ecomerce/img/icons/sales.png') }}" alt="">
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
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Contact us<span>.</span></h2>
                    </div>
                </div>
                <div class="col-lg-8">
                    <img src="img/add.jpg" alt="">
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
                <form action="{{ route('public.contact.store') }}" method="POST" class="contact-form">
    @csrf
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
                <div class="col-lg-3 offset-lg-1">
                    <div class="contact-widget">
                        <div class="cw-item">
                            <h5>Location</h5>
                            <ul>
                                <li>Jl. BSD Raya Utama,</li>
                                <li>Tangerang, Banten, Indonesia</li>
                            </ul>
                        </div>
                        <div class="cw-item">
                            <h5>Phone</h5>
                            <ul>
                                <li>+62 896 8611 5596</li>
                            </ul>
                        </div>
                        <div class="cw-item">
                            <h5>E-mail</h5>
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
    <footer class="footer-section spad">
        <div class="container">
            <div class="footer-widget">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="single-footer-widget">
                            <h4>Cerita tentang T-Shirt</h4>
                            <p>T-Shirt bukan hanya sebuah pakaian, tetapi juga simbol dari gaya hidup, ekspresi diri, dan kenyamanan. Sejarah T-Shirt bermula dari pakaian dalam militer di awal abad ke-20, yang kemudian berevolusi menjadi salah satu pakaian paling populer di seluruh dunia. Kami terinspirasi untuk menghadirkan desain yang tidak hanya menarik, tetapi juga memiliki cerita dan makna. Setiap T-Shirt yang kami ciptakan dirancang dengan perhatian penuh terhadap detail, mulai dari pemilihan bahan berkualitas tinggi hingga proses pembuatan yang ramah lingkungan.</p>
                            <p>Kami percaya bahwa setiap orang berhak untuk tampil gaya tanpa mengorbankan kenyamanan. Oleh karena itu, kami menggunakan bahan-bahan terbaik yang lembut di kulit, tahan lama, dan cocok untuk segala aktivitas. Melalui inovasi desain dan komitmen terhadap kualitas, kami terus berupaya menghadirkan produk yang mencerminkan kepribadian Anda sekaligus memberikan pengalaman terbaik dalam berpakaian.</p>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="social-links-warp">
            <div class="container text-center">
                <div class="social-links">
                    <a href="#" class="instagram"><i class="fa fa-instagram"></i><span>Instagram</span></a>
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>
                    <a href="#" class="youtube"><i class="fa fa-youtube"></i><span>YouTube</span></a>
                </div>
            </div>
            <div class="container text-center pt-3">
                <p>&copy;<script>document.write(new Date().getFullYear());</script> Hak Cipta Dilindungi | Dibuat dengan <i class="icon-heart" aria-hidden="true"></i> oleh <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('ecomerce/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('ecomerce/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('ecomerce/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('ecomerce/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('ecomerce/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('ecomerce/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('ecomerce/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('ecomerce/js/main.js') }}"></script>
</body>

</html>