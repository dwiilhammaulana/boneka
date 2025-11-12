<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembayaran - GoldenToys</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Balsamiq+Sans:wght@400;700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            background: linear-gradient(rgba(253, 224, 71, 0.1), rgba(245, 158, 11, 0.1)), 
                        url('https://source.unsplash.com/1600x900/?car,showroom') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Quicksand', sans-serif;
            color: #4A5568;
        }

        .payment-container {
            width: 100%;
            max-width: 900px;
            margin: 20px;
        }

        .page-title {
            color: var(--white);
            font-weight: 700;
            font-family: 'Comic Neue', cursive;
            text-shadow: 2px 2px 0px rgba(0,0,0,0.3);
            margin-bottom: 30px;
            text-align: center;
        }

        .page-title i {
            color: var(--yellow);
            margin-right: 15px;
        }

        .card {
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 15px 35px rgba(245, 158, 11, 0.2);
            border: 3px solid var(--yellow);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--yellow), var(--orange));
            color: #4A5568;
            border-bottom: 3px solid var(--dark-yellow);
            padding: 20px;
        }

        .card-header h5 {
            font-weight: 700;
            margin: 0;
            font-family: 'Comic Neue', cursive;
        }

        .card-body {
            padding: 30px;
        }

        .badge-custom {
            background: linear-gradient(135deg, var(--orange), var(--dark-yellow));
            color: var(--white);
            font-size: 0.9rem;
            padding: 8px 15px;
            border-radius: 15px;
            font-weight: 600;
        }

        .form-control, .form-select {
            border: 2px solid var(--yellow);
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: var(--light-bg);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 0.3rem rgba(251, 146, 60, 0.25);
            background-color: var(--white);
        }

        .form-control.bg-light {
            background-color: var(--light-bg) !important;
            border-color: var(--blue);
            font-weight: 600;
            color: var(--dark-yellow);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-yellow);
            margin-bottom: 8px;
        }

        .alert {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: linear-gradient(135deg, var(--green), #28a745);
            color: var(--white);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        .alert-info {
            background: linear-gradient(135deg, var(--blue), #17a2b8);
            color: var(--white);
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.3);
        }

        .alert-warning {
            background: linear-gradient(135deg, var(--yellow), var(--orange));
            color: #4A5568;
            box-shadow: 0 5px 15px rgba(253, 224, 71, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--green), #28a745);
            border: none;
            color: var(--white);
            padding: 15px 30px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
            width: 100%;
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.6);
            background: linear-gradient(135deg, #28a745, var(--green));
        }

        .order-detail {
            background: var(--light-bg);
            border-radius: 15px;
            padding: 20px;
            border-left: 4px solid var(--orange);
            margin-bottom: 25px;
        }

        .order-detail h6 {
            color: var(--dark-yellow);
            font-weight: 700;
            margin-bottom: 15px;
            font-family: 'Comic Neue', cursive;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid rgba(245, 158, 11, 0.2);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #4A5568;
        }

        .detail-value {
            font-weight: 700;
            color: var(--dark-yellow);
        }

        .invalid-feedback {
            color: var(--danger);
            font-weight: 600;
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--danger);
            box-shadow: 0 0 0 0.3rem rgba(220, 53, 69, 0.25);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .payment-container {
                margin: 10px;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .page-title {
                font-size: 1.8rem;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }
    </style>
</head>
<body>

<div class="payment-container">
    <h1 class="page-title">
        <i class="fas fa-credit-card"></i>Form Pembayaran GoldenToys
    </h1>

    @if(session('success'))
        <div class="alert alert-success" id="success-alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info" id="info-alert">
            <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-file-invoice-dollar me-2"></i>Detail Pembayaran</h5>
                </div>
                <div class="card-body">
                    <form id="formPembayaran" action="{{ route('public.PublicPembayaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if(!empty($selectedOrderId))
                            @php
                                $order = $orders->where('order_id', $selectedOrderId)->first();
                            @endphp

                            @if($order)
                                <div class="order-detail">
                                    <h6><i class="fas fa-receipt me-2"></i>Detail Pesanan</h6>
                                    <div class="detail-row">
                                        <span class="detail-label">No Pesanan:</span>
                                        <span class="badge-custom">ID: {{ $order->order_id }}</span>
                                    </div>
                                    <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><i class="fas fa-money-bill-wave me-2"></i>Total Bayar</label>
                                        <input type="text" class="form-control bg-light" value="Rp {{ number_format($order->total_price, 0, ',', '.') }}" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><i class="fas fa-receipt me-2"></i>Sisa Tagihan</label>
                                        <input type="text" class="form-control bg-light" value="Rp {{ number_format($order->sisa_tagihan, 0, ',', '.') }}" readonly>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Pesanan tidak ditemukan.
                                </div>
                            @endif

                            <div class="mb-4">
                                <label class="form-label"><i class="fas fa-money-check me-2"></i>Jenis Pembayaran</label>
                                <input type="text" class="form-control bg-light" value="{{ ucfirst($jenisPembayaran) }}" readonly>
                                <input type="hidden" name="jenis_pembayaran" value="{{ $jenisPembayaran }}">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_pembayaran" class="form-label">
                                        <i class="fas fa-calendar-day me-2"></i>Tanggal Pembayaran
                                    </label>
                                    <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran"
                                           class="form-control @error('tanggal_pembayaran') is-invalid @enderror"
                                           value="{{ old('tanggal_pembayaran', date('Y-m-d')) }}">
                                    @error('tanggal_pembayaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="metode" class="form-label">
                                        <i class="fas fa-credit-card me-2"></i>Metode Pembayaran
                                    </label>
                                    <select name="metode" id="metode" class="form-select @error('metode') is-invalid @enderror" onchange="toggleBuktiBayar()">
                                        <option value="" disabled selected>Pilih Metode</option>
                                        <option value="tunai" {{ old('metode') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                        <option value="transfer" {{ old('metode') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                    </select>
                                    @error('metode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4" id="bukti-bayar-group" style="display: none;">
                                <label for="bukti_bayar" class="form-label">
                                    <i class="fas fa-upload me-2"></i>Upload Bukti Pembayaran
                                </label>
                                <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control @error('bukti_bayar') is-invalid @enderror" accept=".jpg,.jpeg,.png,.pdf">
                                <div class="form-text text-muted mt-2">
                                    <i class="fas fa-info-circle me-1"></i>Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.
                                </div>
                                @error('bukti_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane me-2"></i>Bayar Sekarang
                                </button>
                            </div>
                        @else
                            <div class="alert alert-warning text-center">
                                <i class="fas fa-shopping-cart me-2"></i>Silakan pilih pesanan terlebih dahulu.
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleBuktiBayar() {
        const metode = document.getElementById('metode').value;
        const buktiGroup = document.getElementById('bukti-bayar-group');
        const buktiInput = document.getElementById('bukti_bayar');

        if (metode === 'transfer') {
            buktiGroup.style.display = 'block';
            buktiInput.required = true;
        } else {
            buktiGroup.style.display = 'none';
            buktiInput.required = false;
            buktiInput.value = '';
        }
    }

    // Trigger on page load if old value exists
    window.onload = function () {
        toggleBuktiBayar();
    };

    // SweetAlert form validation
    document.getElementById('formPembayaran').addEventListener('submit', function (e) {
        const tanggal = document.getElementById('tanggal_pembayaran').value;
        const metode = document.getElementById('metode').value;
        const bukti = document.getElementById('bukti_bayar').value;

        if (!tanggal || !metode || (metode === 'transfer' && !bukti)) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Form belum lengkap!',
                text: 'Harap lengkapi semua data yang dibutuhkan.',
                confirmButtonColor: '#F59E0B',
                confirmButtonText: 'OK',
                background: 'var(--light-bg)',
                color: '#4A5568'
            });
        }
    });

    // Hide alert after 3 seconds
    setTimeout(() => {
        const alerts = ['success-alert', 'info-alert'];
        alerts.forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.style.transition = 'opacity 0.5s ease-out';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            }
        });
    }, 3000);
</script>

</body>
</html>