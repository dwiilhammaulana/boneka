<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>MobilShift - Invoice</title>
    
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
            --green: #4ADE80;
            --danger: #dc3545;
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

        /* ===== INVOICE STYLES ===== */
        .invoice-box {
            background: var(--white);
            padding: 40px;
            margin: 40px auto;
            border: 3px solid var(--yellow);
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(253, 224, 71, 0.15);
        }

        .invoice-box h2 {
            color: var(--dark-yellow);
            font-weight: 700;
            font-family: 'Comic Neue', cursive;
            text-shadow: 2px 2px 0px var(--yellow);
            margin-bottom: 30px;
        }

        .highlight {
            background: linear-gradient(135deg, var(--yellow), var(--orange));
            color: #4A5568;
            padding: 15px;
            border-radius: 15px;
            margin: 25px 0;
            border: 2px solid var(--dark-yellow);
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
            border: 2px solid var(--yellow);
        }

        .table-light {
            background: linear-gradient(135deg, var(--yellow), var(--orange)) !important;
            color: #4A5568;
        }

        .table th {
            font-weight: 700;
            border-bottom: 2px solid var(--dark-yellow);
        }

        .table > :not(:first-child) {
            border-top: 2px solid var(--yellow);
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid var(--yellow);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(253, 224, 71, 0.1);
        }

        .total-box {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-yellow);
            padding: 15px;
            background: var(--light-bg);
            border-radius: 10px;
            border-left: 4px solid var(--orange);
        }

        .text-danger {
            color: var(--danger) !important;
            font-weight: 600;
        }

        /* ===== FORM STYLES ===== */
        .form-control {
            border: 2px solid var(--yellow);
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            background-color: var(--light-bg);
        }

        .form-control:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 0.3rem rgba(251, 146, 60, 0.25);
            background-color: var(--white);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-yellow);
            margin-bottom: 8px;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--green), #28a745);
            border: none;
            color: var(--white);
            padding: 15px 40px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.6);
            background: linear-gradient(135deg, #28a745, var(--green));
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
            
            .invoice-box {
                padding: 25px;
                margin: 20px auto;
            }
            
            .highlight {
                text-align: center;
            }
            
            .table-responsive {
                font-size: 0.9rem;
            }
            
            .btn-success {
                width: 100%;
            }
            
            .header-item {
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header class="header-section">
        <div class="container-fluid">
            <div class="inner-header">
                <div class="logo">
                    <a href="{{ route('public.home') }}"><h4>MobilShift</h4></a>
                </div>

                <!-- Navigation Menu -->
                <nav class="main-menu mobile-menu">
                    <ul>
                        <li><a href="{{ route('public.home') }}">Home</a></li>
                        <li><a href="{{ route('public.shop') }}">Shop</a></li>
                        <li><a href="{{ route('public.contact') }}">Contact</a></li>
                        
                        @auth('customer')
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


    <!-- INVOICE CONTENT -->
    <div class="container">
        <div class="invoice-box">
            <h2 class="text-center mb-4">
                <i class="fas fa-receipt me-2"></i>Invoice Pembelian
            </h2>

            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-store me-2"></i>Dari</strong><br>
                    <b>MS - MobilShift</b><br>
                    Arengka 1 No 36 D-E, Jl. Soekarno - Hatta,<br>
                    Sidomulyo Tim., Kecamatan Marpoyan, Kota Pekanbaru, Riau 28125<br>
                    <strong><i class="fas fa-phone me-2"></i>No HP:</strong> 0852-6552-7838<br>
                    <strong><i class="fas fa-envelope me-2"></i>Email:</strong> info@ms.com
                </div>
                <div class="col-md-6 text-end">
                    <h4 class="text-dark-yellow">
                        <i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}
                    </h4>
                    <strong><i class="fas fa-user me-2"></i>Kepada</strong><br>
                    {{ Auth::guard('customer')->user()->username }}<br>
                    <strong><i class="fas fa-phone me-2"></i>No HP:</strong> {{ Auth::guard('customer')->user()->phone_number }}<br>
                    <strong><i class="fas fa-envelope me-2"></i>Email:</strong> {{ Auth::guard('customer')->user()->email }}<br>
                </div>
            </div>

            <div class="row highlight mt-4">
                <div class="col-md-6">
                    <i class="fas fa-calendar-day me-2"></i>Tanggal Pembelian: 
                    <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong>
                </div>
                <div class="col-md-6">
                    <i class="fas fa-id-card me-2"></i>Account: 
                    <strong>{{ Auth::guard('customer')->user()->customer_id }}</strong>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Tipe Produk</th>
                            <th>Warna Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($cart))
                            @foreach($cart as $id => $item)
                                <tr>
                                    <td class="fw-bold">{{ $loop->iteration }}</td>
                                    <td>
                                        @if(!empty($item['image']))
                                            <img src="{{ asset('img/' . $item['image']) }}" alt="{{ $item['name'] }}" 
                                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px; border: 2px solid var(--yellow);">
                                        @else
                                            <div class="text-muted" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; background: var(--light-bg); border-radius: 10px; border: 2px dashed var(--yellow);">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $item['name'] }}</td>
                                    <td>{{ $item['kilometer'] ?? '-' }}</td>
                                    <td>
                                        <span class="badge" style="background: var(--yellow); color: #4A5568;">
                                            {{ $item['warna'] }}
                                        </span>
                                    </td>
                                    <td class="text-center fw-bold">{{ $item['quantity'] }}</td>
                                    <td class="fw-bold text-dark-yellow">Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-shopping-cart fa-2x text-muted mb-2"></i><br>
                                    Keranjang Anda kosong.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @php
                $bukti_pesanan = 500000;
                $totalProduk = 0;
                if(!empty($cart)) {
                    foreach($cart as $item) {
                        $totalProduk += $item['price'] * $item['quantity'];
                    }
                }
                $total = $totalProduk + $bukti_pesanan;
                $bayar_sebelum = \Carbon\Carbon::now()->addDays(7)->locale('id')->isoFormat('D MMMM YYYY');
            @endphp

            <div class="mt-4 p-4" style="background: var(--light-bg); border-radius: 15px; border-left: 4px solid var(--orange);">
                <p class="mb-2">
                    <strong><i class="fas fa-clock me-2"></i>Bayar Sebelum Tanggal:</strong> 
                    <span class="text-danger fw-bold">{{ $bayar_sebelum }}</span>
                </p>
                <p class="mb-2">
                    <strong><i class="fas fa-cubes me-2"></i>Jumlah Total Produk:</strong> 
                    Rp {{ number_format($totalProduk, 0, ',', '.') }}
                </p>
                <p class="mb-2">
                    <strong><i class="fas fa-money-bill-wave me-2"></i>Bukti Pesanan:</strong> 
                    Rp {{ number_format($bukti_pesanan, 0, ',', '.') }}
                </p>
                <p class="total-box mb-0">
                    <strong><i class="fas fa-receipt me-2"></i>Total Pembayaran:</strong> 
                    Rp {{ number_format($total, 0, ',', '.') }}
                </p>
            </div>

            <!-- FORM untuk submit data -->
            <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf

                <!-- Hidden Inputs -->
                <input type="hidden" name="customer_id" value="{{ Auth::guard('customer')->user()->customer_id }}">
                <input type="hidden" name="order_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="total_price" value="{{ $total }}">
                <input type="hidden" name="bukti_pesanan" value="{{ $bukti_pesanan }}">
                <input type="hidden" name="status" value="Menunggu">

                <!-- Order Details -->
                @foreach ($cart as $id => $item)
                    <input type="hidden" name="order_details[{{ $loop->index }}][product_id]" value="{{ $id }}">
                    <input type="hidden" name="order_details[{{ $loop->index }}][quantity]" value="{{ $item['quantity'] }}">
                    <input type="hidden" name="order_details[{{ $loop->index }}][price]" value="{{ $item['price'] }}">
                @endforeach

                <!-- Upload Foto KTP -->
                <div class="mb-4">
                    <label for="ktp" class="form-label">
                        <strong><i class="fas fa-id-card me-2"></i>Upload Foto KTP</strong>
                    </label>
                    <input type="file" class="form-control" id="ktp" name="ktp" accept="image/*" required>
                    <div class="form-text">Format yang diterima: JPG, PNG, JPEG. Maksimal 2MB.</div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-check-circle me-2"></i>Buat Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>