<!-- resources/views/public/layouts/header.blade.php -->
<!DOCTYPE html> 
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SECLOTH</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('ecomerce/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ecomerce/css/style.css') }}" type="text/css">
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
                    <a href="{{ url('/') }}"><img src="{{ asset('ecomerce/img/logo.png') }}" alt=""></a>
                </div>
                <div class="header-right">
                    <img src="{{ asset('ecomerce/img/icons/man.png') }}" alt="">
                    <a href="shopping-cart.html">
                        <img src="{{ asset('ecomerce/img/icons/bag.png') }}" alt="">
                        <span>2</span>
                    </a>
                </div>
                <div class="user-access">
                    <a href="#">Register</a>
                    <a href="#" class="in">Sign in</a>
                </div>
                <nav class="main-menu mobile-menu">
                    <ul>
                        <li><a class="active" href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/categories') }}">Shop</a>
                            <ul class="sub-menu">
                                <li><a href="product-page.html">Product Page</a></li>
                                <li><a href="shopping-cart.html">Shopping Card</a></li>
                                <li><a href="check-out.html">Check out</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <li><a href="{{ url('/blog') }}">Blog</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
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
