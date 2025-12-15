<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>GoldenToys - Checkout</title>
    
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

        /* ===== CHECKOUT STYLES ===== */
        .checkout-box {
            background: var(--white);
            padding: 40px;
            margin: 40px auto;
            border: 3px solid var(--yellow);
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(253, 224, 71, 0.15);
        }

        .checkout-box h2 {
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

        .section-title {
            color: var(--dark-yellow);
            border-bottom: 2px solid var(--yellow);
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 700;
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
            
            .checkout-box {
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
                    <a href="{{ route('public.home') }}"><h4>GoldenToys</h4></a>
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

    <!-- CHECKOUT CONTENT -->
    <div class="container">
        <div class="checkout-box">
            <h2 class="text-center mb-4">
                <i class="fas fa-shopping-cart me-2"></i>Checkout
            </h2>

            <!-- Tampilkan error/success messages -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Informasi Customer -->
            <div class="alert alert-info" style="background: linear-gradient(135deg, var(--yellow), var(--orange)); border: 2px solid var(--dark-yellow);">
                <div class="row">
                    <div class="col-md-6">
                        <h5><i class="fas fa-user me-2"></i>Informasi Customer</h5>
                        <p class="mb-1"><strong>Nama:</strong> {{ Auth::guard('customer')->user()->username }}</p>
                        <p class="mb-1"><strong>Customer ID:</strong> {{ Auth::guard('customer')->user()->customer_id }}</p>
                        <p class="mb-0"><strong>Email:</strong> {{ Auth::guard('customer')->user()->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-info-circle me-2"></i>Status Pesanan</h5>
                        <p class="mb-1"><strong>Tanggal Order:</strong> {{ date('d-m-Y H:i:s') }}</p>
                        <p class="mb-1"><strong>Status:</strong> <span id="status-info">Akan ditentukan berdasarkan metode pembayaran</span></p>
                        <p class="mb-0"><strong>No. Telepon Terdaftar:</strong> {{ Auth::guard('customer')->user()->phone_number }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Produk -->
            <div class="section-title">
                <i class="fas fa-box me-2"></i>Detail Produk
            </div>

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Warna</th>
                            <th>Harga Normal</th>
                            <th>Diskon</th>
                            <th>Harga Setelah Diskon</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalProduk = 0;
                            $totalDiskon = 0;
                            $totalHargaNormal = 0;
                        @endphp

                        @if(!empty($cart))
                            @foreach($cart as $id => $item)
                                @php
                                    $hargaNormal = $item['price'] ?? 0;
                                    $discount = $item['discount'] ?? 0;

                                    if ($discount > 0) {
                                        $hargaJual = $item['harga_jual'] ?? ($hargaNormal - ($hargaNormal * $discount / 100));
                                    } else {
                                        $hargaJual = $hargaNormal;
                                    }

                                    $subtotal = $hargaJual * $item['quantity'];
                                    $subtotalNormal = $hargaNormal * $item['quantity'];

                                    $totalProduk += $subtotal;
                                    $totalHargaNormal += $subtotalNormal;
                                    $totalDiskon += ($subtotalNormal - $subtotal);
                                @endphp

                                <tr>
                                    <td class="fw-bold">{{ $loop->iteration }}</td>
                                    <td>
                                        @if(!empty($item['image']))
                                            <img src="{{ asset('img/' . $item['image']) }}"
                                                 alt="{{ $item['name'] }}"
                                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px; border: 2px solid var(--yellow);">
                                        @else
                                            <div class="text-muted"
                                                 style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; background: var(--light-bg); border-radius: 10px; border: 2px dashed var(--yellow);">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $item['name'] }}</td>
                                    <td>
                                        <span class="badge" style="background: var(--yellow); color: #4A5568;">
                                            {{ $item['warna'] ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-muted" style="text-decoration: line-through;">
                                        Rp{{ number_format($hargaNormal, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        @if($discount > 0)
                                            <span class="badge bg-success">{{ $discount }}%</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-dark-yellow">
                                        Rp{{ number_format($hargaJual, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center fw-bold">{{ $item['quantity'] }}</td>
                                    <td class="fw-bold text-dark-yellow">
                                        Rp{{ number_format($subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <i class="fas fa-shopping-cart fa-2x text-muted mb-2"></i><br>
                                    Keranjang Anda kosong.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- FORM untuk checkout -->
            <form action="{{ route('orders.store') }}" method="POST" class="mt-5" id="checkoutForm">
                @csrf

                <!-- Hidden Inputs - SESUAI DENGAN $fillable di model -->
                <input type="hidden" name="customer_id" value="{{ Auth::guard('customer')->user()->customer_id }}">
                <input type="hidden" name="receiver_name" value="{{ Auth::guard('customer')->user()->username }}">
                <input type="hidden" name="order_date" value="{{ date('Y-m-d H:i:s') }}">
                <input type="hidden" name="total_price" id="total_price" value="{{ $totalProduk }}">
                <input type="hidden" name="shipping_cost" id="shipping_cost" value="{{ $shippingCost ?? 10000 }}">
                <input type="hidden" name="grand_total" id="grand_total" value="{{ ($totalProduk + ($shippingCost ?? 10000)) }}">
                <!-- STATUS TIDAK DIPERLUKAN LAGI KARENA OTOMATIS -->
                
                <!-- Hidden untuk informasi diskon -->
                <input type="hidden" name="total_discount" id="total_discount" value="{{ $totalDiskon }}">
                <input type="hidden" name="total_before_discount" id="total_before_discount" value="{{ $totalHargaNormal }}">

                <!-- Order Details -->
                @foreach ($cart as $id => $item)
                    @php
                        $discount = $item['discount'] ?? 0;
                        $hargaJual = $item['price'] ?? $item['harga_jual'] ?? 0;
                        $hargaNormal = $item['harga_normal'] ?? $hargaJual;
                    @endphp
                    <input type="hidden" name="order_details[{{ $loop->index }}][product_id]" value="{{ $id }}">
                    <input type="hidden" name="order_details[{{ $loop->index }}][quantity]" value="{{ $item['quantity'] }}">
                    <input type="hidden" name="order_details[{{ $loop->index }}][price]" value="{{ $hargaJual }}">
                    <input type="hidden" name="order_details[{{ $loop->index }}][discount]" value="{{ $discount }}">
                    <input type="hidden" name="order_details[{{ $loop->index }}][original_price]" value="{{ $hargaNormal }}">
                @endforeach

                <!-- Informasi Kontak & Pengiriman -->
                <div class="section-title mt-4">
                    <i class="fas fa-truck me-2"></i>Informasi Pengiriman
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="receiver_phone" class="form-label">
                                <i class="fas fa-phone me-2"></i>Nomor Telepon Penerima <span class="text-danger">*</span>
                            </label>
                            <input type="tel" class="form-control @error('receiver_phone') is-invalid @enderror" 
                                   id="receiver_phone" name="receiver_phone" 
                                   value="{{ old('receiver_phone', Auth::guard('customer')->user()->phone_number) }}" 
                                   required maxlength="20"
                                   placeholder="Contoh: 081234567890">
                            @error('receiver_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Nomor aktif untuk konfirmasi pengiriman (boleh berbeda dari nomor terdaftar)</div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">
                                <i class="fas fa-credit-card me-2"></i>Metode Pembayaran <span class="text-danger">*</span>
                            </label>
                            <select class="form-control @error('payment_method') is-invalid @enderror" 
                                    id="payment_method" name="payment_method" required>
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Cash on Delivery (COD)</option>
                                <option value="gateway" {{ old('payment_method') == 'gateway' ? 'selected' : '' }}>Pembayaran Online (Gateway)</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <span id="cod-info" style="display: none;">
                                    <i class="fas fa-money-bill-wave me-1"></i><strong>COD:</strong> Bayar saat barang diterima. Pesanan langsung diproses.
                                </span>
                                <span id="gateway-info" style="display: none;">
                                    <i class="fas fa-credit-card me-1"></i><strong>Gateway:</strong> Transfer bank/ewallet. Pesanan menunggu pembayaran.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
    <div class="col-12">
        <div class="mb-3">
            <label for="shipping_address" class="form-label">
                <i class="fas fa-map-marker-alt me-2"></i>Alamat Lengkap Pengiriman <span class="text-danger">*</span>
            </label>
            <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                      id="shipping_address" name="shipping_address" 
                      rows="4" required
                      placeholder="Contoh:&#10;Nama Penerima: {{ Auth::guard('customer')->user()->username }}&#10;Alamat Lengkap: Jl. Merdeka No. 123, RT 01/RW 02&#10;Kelurahan Sudimara, Kecamatan Ciledug&#10;Kota Tangerang, Provinsi Banten&#10;Kode Pos: 15151&#10;Catatan: Dekat sekolah SMPN 5">{{ old('shipping_address', Auth::guard('customer')->user()->address ?? '') }}</textarea>
            @error('shipping_address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">
                Masukkan semua informasi pengiriman lengkap dalam satu kolom ini
            </div>
        </div>
    </div>
</div>

                <!-- Catatan Pelanggan -->
                <div class="mb-4">
                    <label for="customer_note" class="form-label">
                        <i class="fas fa-sticky-note me-2"></i>Catatan Tambahan (Opsional)
                    </label>
                    <textarea class="form-control" id="customer_note" name="customer_note" rows="3" 
                              placeholder="Contoh: Tolong dibungkus dengan bubble wrap, jangan ada stiker harga, kirim di pagi hari...">{{ old('customer_note') }}</textarea>
                    <div class="form-text">Catatan khusus untuk penjual terkait pesanan Anda</div>
                </div>

                <!-- Ringkasan Pembayaran dengan DISKON -->
                <div class="section-title mt-5">
                    <i class="fas fa-receipt me-2"></i>Ringkasan Pembayaran
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="p-4" style="background: var(--light-bg); border-radius: 15px; border-left: 4px solid var(--orange);">
                            <p class="mb-2">
                                <strong><i class="fas fa-user me-2"></i>Customer ID:</strong> 
                                <span class="float-end">{{ Auth::guard('customer')->user()->customer_id }}</span>
                            </p>
                            <p class="mb-2">
                                <strong><i class="fas fa-cubes me-2"></i>Total Harga Normal:</strong> 
                                <span class="float-end text-muted" style="text-decoration: line-through;" id="display_total_normal">
                                    Rp {{ number_format($totalHargaNormal, 0, ',', '.') }}
                                </span>
                            </p>
                            
                            @if($totalDiskon > 0)
                            <p class="mb-2">
                                <strong><i class="fas fa-tag me-2 text-success"></i>Total Diskon:</strong> 
                                <span class="float-end text-success" id="display_total_discount">
                                    -Rp {{ number_format($totalDiskon, 0, ',', '.') }}
                                </span>
                            </p>
                            <p class="mb-2">
                                <strong><i class="fas fa-percentage me-2 text-success"></i>Persentase Diskon:</strong> 
                                <span class="float-end text-success fw-bold" id="display_discount_percentage">
                                    {{ $totalHargaNormal > 0 ? number_format(($totalDiskon / $totalHargaNormal * 100), 1) : 0 }}%
                                </span>
                            </p>
                            <p class="mb-2">
                                <strong><i class="fas fa-money-bill-wave me-2"></i>Total Harga Setelah Diskon:</strong> 
                                <span class="float-end fw-bold" id="display_total_price">
                                    Rp {{ number_format($totalProduk, 0, ',', '.') }}
                                </span>
                            </p>
                            @else
                            <p class="mb-2">
                                <strong><i class="fas fa-cubes me-2"></i>Total Harga Produk:</strong> 
                                <span class="float-end" id="display_total_price">
                                    Rp {{ number_format($totalProduk, 0, ',', '.') }}
                                </span>
                            </p>
                            @endif
                            
                            <p class="mb-2">
                                <strong><i class="fas fa-truck me-2"></i>Biaya Pengiriman:</strong> 
                                <span class="float-end" id="display_shipping_cost">Rp {{ number_format(($shippingCost ?? 10000), 0, ',', '.') }}</span>
                            </p>
                            
                            <!-- Info Status Berdasarkan Pembayaran -->
                            <div class="alert alert-warning py-2 my-2" id="status-alert" style="background: rgba(245, 158, 11, 0.1); border: 1px solid var(--orange);">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Status Pesanan:</strong> 
                                <span class="float-end fw-bold" id="display_status">Pilih metode pembayaran</span>
                            </div>
                            
                            @if($totalDiskon > 0)
                            <div class="alert alert-success py-2 my-2" style="background: rgba(72, 187, 120, 0.1); border: 1px solid var(--green);">
                                <i class="fas fa-piggy-bank me-2"></i>
                                <strong>Anda hemat:</strong> 
                                <span class="float-end fw-bold">Rp {{ number_format($totalDiskon, 0, ',', '.') }}</span>
                            </div>
                            @endif
                            
                            <hr>
                            <p class="total-box mb-0">
                                <strong><i class="fas fa-receipt me-2"></i>Grand Total:</strong> 
                                <span class="float-end" id="display_grand_total">Rp {{ number_format(($totalProduk + ($shippingCost ?? 10000)), 0, ',', '.') }}</span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="p-4" style="background: var(--light-bg); border-radius: 15px; border: 2px solid var(--yellow);">
                            <h5 class="text-dark-yellow mb-3">
                                <i class="fas fa-info-circle me-2"></i>Informasi Penting
                            </h5>
                            <ul class="list-unstyled" style="font-size: 0.9rem;">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i><strong>Customer ID Anda:</strong> {{ Auth::guard('customer')->user()->customer_id }}</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pastikan data pengiriman sudah benar</li>
                                
                                @if($totalDiskon > 0)
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i><strong class="text-success">🏷️ Anda mendapatkan diskon!</strong></li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Total diskon: <strong>Rp {{ number_format($totalDiskon, 0, ',', '.') }}</strong></li>
                                @endif
                                
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Simpan bukti transfer jika pilih Gateway</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Status otomatis berdasarkan pembayaran</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pesanan bisa dicek di menu "Pesanan"</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i><strong>COD:</strong> Langsung diproses</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i><strong>Gateway:</strong> Menunggu pembayaran</li>
                            </ul>
                            
                            @if($totalDiskon > 0)
                            <div class="mt-3 p-2 text-center" style="background: linear-gradient(135deg, var(--yellow), var(--orange)); border-radius: 8px;">
                                <i class="fas fa-gift me-1"></i>
                                <strong>Selamat! Anda hemat {{ $totalHargaNormal > 0 ? number_format(($totalDiskon / $totalHargaNormal * 100), 1) : 0 }}%</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Syarat dan Ketentuan -->
                <div class="form-check mt-4 mb-3">
                    <input class="form-check-input" type="checkbox" id="terms" required>
                    <label class="form-check-label" for="terms">
                        <i class="fas fa-file-contract me-2"></i>Saya sebagai Customer ID: <strong>{{ Auth::guard('customer')->user()->customer_id }}</strong> telah membaca dan menyetujui 
                        <a href="#" class="text-dark-yellow fw-bold">Syarat & Ketentuan</a> 
                        serta 
                        <a href="#" class="text-dark-yellow fw-bold">Kebijakan Privasi</a>
                        GoldenToys
                    </label>
                </div>

                <!-- Tombol Submit -->
                <div class="text-center mt-5">
                    <a href="{{ route('public.cart') }}" class="btn btn-outline-dark btn-lg me-3">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Keranjang
                    </a>
                    <button type="submit" class="btn btn-success btn-lg" id="submitBtn">
                        <i class="fas fa-check-circle me-2"></i>Konfirmasi Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Format nomor telepon (hanya angka)
        document.getElementById('receiver_phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                value = value.substring(0, 15);
            }
            e.target.value = value;
        });

        // Tampilkan info dan update status berdasarkan metode pembayaran
        document.getElementById('payment_method').addEventListener('change', function() {
            const value = this.value;
            
            // Tampilkan info pembayaran
            document.getElementById('cod-info').style.display = value === 'cod' ? 'inline' : 'none';
            document.getElementById('gateway-info').style.display = value === 'gateway' ? 'inline' : 'none';
            
            // Update status info
            const statusInfo = document.getElementById('status-info');
            const displayStatus = document.getElementById('display_status');
            
            if (value === 'cod') {
                statusInfo.innerHTML = '<span class="text-success">COD: Langsung diproses</span>';
                displayStatus.textContent = 'diproses';
                displayStatus.className = 'fw-bold text-success';
                document.getElementById('status-alert').className = 'alert alert-success py-2 my-2';
            } else if (value === 'gateway') {
                statusInfo.innerHTML = '<span class="text-warning">Gateway: Menunggu pembayaran</span>';
                displayStatus.textContent = 'menunggu';
                displayStatus.className = 'fw-bold text-warning';
                document.getElementById('status-alert').className = 'alert alert-warning py-2 my-2';
            } else {
                statusInfo.textContent = 'Akan ditentukan berdasarkan metode pembayaran';
                displayStatus.textContent = 'Pilih metode pembayaran';
                displayStatus.className = 'fw-bold text-muted';
                document.getElementById('status-alert').className = 'alert alert-warning py-2 my-2';
            }
        });

        // Hitung jumlah karakter di alamat pengiriman
        document.getElementById('shipping_address').addEventListener('input', function() {
            const length = this.value.length;
            const minLength = 30;
            const charCount = document.getElementById('char-count');
            
            charCount.textContent = `${length} karakter (minimal ${minLength} karakter)`;
            
            if (length < minLength) {
                charCount.className = 'text-danger mt-1';
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
            } else {
                charCount.className = 'text-success mt-1';
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });

        // Auto-calculate shipping cost based on address
        document.getElementById('shipping_address').addEventListener('blur', function() {
            const address = this.value.toLowerCase();
            const shippingCostInput = document.getElementById('shipping_cost');
            const grandTotalInput = document.getElementById('grand_total');
            const totalPriceInput = document.getElementById('total_price');
            const totalBeforeDiscountInput = document.getElementById('total_before_discount');
            const totalDiscountInput = document.getElementById('total_discount');
            
            let cost = 10000; // default
            
            if (address.includes('jakarta') || address.includes('bogor') || address.includes('depok') || 
                address.includes('tangerang') || address.includes('bekasi')) {
                cost = 15000; // Jabodetabek
            } else if (address.includes('bandung') || address.includes('surabaya') || 
                      address.includes('semarang') || address.includes('yogyakarta')) {
                cost = 20000; // Kota besar lainnya di Jawa
            } else if (address.includes('bali') || address.includes('lombok') || 
                      address.includes('medan') || address.includes('palembang')) {
                cost = 25000; // Luar Jawa
            } else if (address.includes('papua') || address.includes('kalimantan') || 
                      address.includes('sulawesi') || address.includes('maluku')) {
                cost = 35000; // Luar pulau Jawa & Bali
            }
            
            // Update hidden inputs
            shippingCostInput.value = cost;
            
            const totalPrice = parseFloat(totalPriceInput.value);
            const grandTotal = totalPrice + cost;
            grandTotalInput.value = grandTotal;
            
            // Update display
            document.getElementById('display_shipping_cost').textContent = 'Rp ' + cost.toLocaleString('id-ID');
            document.getElementById('display_grand_total').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
            
            // Update persentase diskon jika ada
            const totalBeforeDiscount = parseFloat(totalBeforeDiscountInput.value);
            const totalDiscount = parseFloat(totalDiscountInput.value);
            if (totalBeforeDiscount > 0) {
                const discountPercentage = (totalDiscount / totalBeforeDiscount * 100).toFixed(1);
                document.getElementById('display_discount_percentage').textContent = discountPercentage + '%';
            }
        });

        // Validasi form sebelum submit
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            const phone = document.getElementById('receiver_phone').value;
            const address = document.getElementById('shipping_address');
            const addressValue = address.value;
            const payment = document.getElementById('payment_method').value;
            const terms = document.getElementById('terms');
            
            let errorMessage = '';

            // Validasi nomor telepon
            if (!phone || phone.length < 10) {
                errorMessage += '• Nomor telepon penerima harus diisi (minimal 10 digit)\n';
            }

            // Validasi alamat
            if (!addressValue || addressValue.trim().length < 10) {
                errorMessage += '• Alamat pengiriman harus lengkap (minimal 30 karakter)\n';
                errorMessage += '  Harap sertakan semua informasi alamat secara lengkap\n';
                address.classList.add('is-invalid');
            }

            // Validasi metode pembayaran
            if (!payment) {
                errorMessage += '• Pilih metode pembayaran terlebih dahulu\n';
            }

            // Validasi terms and conditions
            if (!terms.checked) {
                errorMessage += '• Anda harus menyetujui Syarat & Ketentuan\n';
            }

            if (errorMessage) {
                e.preventDefault();
                alert('Harap perbaiki data berikut:\n\n' + errorMessage);
                return false;
            }

            // Konfirmasi sebelum submit
            const customerId = "{{ Auth::guard('customer')->user()->customer_id }}";
            const paymentMethod = payment === 'cod' ? 'Cash on Delivery (COD)' : 'Pembayaran Online (Gateway)';
            const totalDiscount = parseFloat(document.getElementById('total_discount').value);
            const status = payment === 'cod' ? 'diproses' : 'menunggu';
            
            let confirmMessage = `Customer ID: ${customerId}\n`;
            confirmMessage += `Metode Pembayaran: ${paymentMethod}\n`;
            confirmMessage += `Status Pesanan: ${status}\n`;
            
            if (totalDiscount > 0) {
                confirmMessage += `\n💰 Anda hemat: Rp ${totalDiscount.toLocaleString('id-ID')}\n`;
            }
            
            confirmMessage += `\nApakah Anda yakin dengan data pesanan ini?\n\nSetelah dikonfirmasi, pesanan akan segera diproses.`;
            
            if (!confirm(confirmMessage)) {
                e.preventDefault();
                return false;
            }

            // Disable tombol submit untuk menghindari double click
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses Pesanan...';
            
            // Form akan di-submit secara normal
            return true;
        });

        // Inisialisasi tampilan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi metode pembayaran
            const paymentMethod = document.getElementById('payment_method').value;
            if (paymentMethod) {
                document.getElementById('payment_method').dispatchEvent(new Event('change'));
            }
            
            // Inisialisasi hitung karakter alamat
            const addressInput = document.getElementById('shipping_address');
            if (addressInput.value.length > 0) {
                addressInput.dispatchEvent(new Event('input'));
            }
            
            // Hitung persentase diskon saat halaman dimuat
            const totalBeforeDiscount = parseFloat(document.getElementById('total_before_discount').value);
            const totalDiscount = parseFloat(document.getElementById('total_discount').value);
            if (totalBeforeDiscount > 0 && totalDiscount > 0) {
                const discountPercentage = (totalDiscount / totalBeforeDiscount * 100).toFixed(1);
                document.getElementById('display_discount_percentage').textContent = discountPercentage + '%';
            }
            
            // Set old value untuk alamat
            @if(old('shipping_address'))
                document.getElementById('shipping_address').value = `{{ old('shipping_address') }}`;
                document.getElementById('shipping_address').dispatchEvent(new Event('input'));
            @endif
            
            // Set old value untuk metode pembayaran
            @if(old('payment_method'))
                document.getElementById('payment_method').value = `{{ old('payment_method') }}`;
                document.getElementById('payment_method').dispatchEvent(new Event('change'));
            @endif
        });
    </script>
</body>
</html>