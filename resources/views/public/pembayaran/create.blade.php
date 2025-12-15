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
        <i class="fas fa-credit-card"></i> Form Pembayaran GoldenToys
    </h1>

    @if(session('success'))
        <div class="alert alert-success" id="success-alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" id="error-alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
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
                    <h5><i class="fas fa-file-invoice-dollar me-2"></i> Detail Pembayaran</h5>
                </div>
                <div class="card-body">
                    <!-- PERUBAHAN DI SINI: route('public.pembayaran.store') -->
                    <form id="formPembayaran" action="{{ route('public.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if($order)
                            <div class="order-detail">
                                <h6><i class="fas fa-receipt me-2"></i> Detail Pesanan</h6>
                                <div class="detail-row">
                                    <span class="detail-label">No Pesanan:</span>
                                    <span class="badge-custom">ID: {{ $order->order_id }}</span>
                                </div>
                                <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                
                                <div class="mt-3">
                                    <p><strong>Total Pesanan:</strong> Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                                    <p><strong>Status:</strong> 
                                        <span class="badge bg-warning">Menunggu Pembayaran</span>
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fas fa-money-bill-wave me-2"></i> Jumlah yang Harus Dibayar</label>
                                    <input type="text" class="form-control bg-light" 
                                           value="Rp {{ number_format($order->grand_total, 0, ',', '.') }}" readonly>
                                    <input type="hidden" name="jumlah_bayar" value="{{ $order->grand_total }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fas fa-calendar-day me-2"></i> Tanggal Pembayaran</label>
                                    <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran"
                                           class="form-control @error('tanggal_pembayaran') is-invalid @enderror"
                                           value="{{ old('tanggal_pembayaran', date('Y-m-d')) }}" required>
                                    @error('tanggal_pembayaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            
                          

                            <!-- Informasi Rekening -->
                            <div class="alert alert-info mb-4">
                                <h6><i class="fas fa-university me-2"></i> Informasi Rekening Pembayaran</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Bank:</strong> BCA (Bank Central Asia)</p>
                                        <p class="mb-1"><strong>No. Rekening:</strong> 1234 5678 9012</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Atas Nama:</strong> GoldenToys Indonesia</p>
                                        <p class="mb-0"><strong>Jumlah Transfer:</strong> Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Catatan -->
                            <div class="alert alert-warning mb-4">
                                <h6><i class="fas fa-exclamation-triangle me-2"></i> Catatan Penting</h6>
                                <ul class="mb-0">
                                    <li>Pastikan jumlah transfer sesuai dengan total pesanan</li>
                                    <li>Upload bukti transfer yang jelas dan terbaca</li>
                                    <li>Pesanan akan diproses setelah pembayaran diverifikasi</li>
                                    <li>Verifikasi pembayaran membutuhkan waktu 1-3 jam kerja</li>
                                </ul>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="button" onclick="payNow()" class="btn btn-success">
                                    <i class="fas fa-paper-plane me-2"></i> Bayar Sekarang
                                </button>
                                <a href="{{ route('public.pesanan') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Pesanan
                                </a>
                            </div>
                        @else
                            <div class="alert alert-warning text-center">
                                <i class="fas fa-shopping-cart me-2"></i> Pesanan tidak ditemukan atau sudah dibayar.
                            </div>
                            <div class="text-center">
                                <a href="{{ route('public.pesanan') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Pesanan
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 


<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.clientKey') }}"></script>

   <script>
function payNow() {
    const tanggal = document.getElementById('tanggal_pembayaran').value;

    if (!tanggal) {
        Swal.fire({
            icon: 'warning',
            title: 'Tanggal belum diisi',
            confirmButtonColor: '#F59E0B'
        });
        return;
    }

    payWithMidtrans();
}

function payWithMidtrans() {
    const form = document.getElementById('formPembayaran');
    const formData = new FormData(form);

    fetch("{{ route('payment.snap') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (!data.snapToken) {
            throw new Error('Snap token gagal dibuat');
        }

        snap.pay(data.snapToken, {
            onSuccess: function(result) {
                submitMidtransResult(result);
            },
            onPending: function(result) {
                submitMidtransResult(result);
            },
            onError: function() {
                Swal.fire('Gagal', 'Pembayaran gagal', 'error');
            }
        });
    })
    .catch(err => {
        Swal.fire('Error', err.message, 'error');
    });
}

function submitMidtransResult(result) {
    const form = document.getElementById('formPembayaran');
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'midtrans_result';
    input.value = JSON.stringify(result);
    form.appendChild(input);
    form.submit();
}
</script>


<script>
    // Hide alert after 3 seconds
    setTimeout(() => {
        const alerts = ['success-alert', 'error-alert', 'info-alert'];
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