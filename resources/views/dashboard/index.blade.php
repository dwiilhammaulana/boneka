@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Dashboard Admin</h1>
</div>

<!-- Summary Cards -->
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-users fa-2x mr-3"></i>
                <div>
                    <h5 class="card-title">Admin</h5>
                    <p class="card-text display-4">{{ $adminCount }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-user-friends fa-2x mr-3"></i>
                <div>
                    <h5 class="card-title">Customer</h5>
                    <p class="card-text display-4">{{ $customerCount }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-cogs fa-2x mr-3"></i>
                <div>
                    <h5 class="card-title">Produk</h5>
                    <p class="card-text display-4">{{ $productCount }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-danger">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-cart-arrow-down fa-2x mr-3"></i>
                <div>
                    <h5 class="card-title">Pesanan</h5>
                    <p class="card-text display-4">{{ $orderCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ringkasan Pesanan -->
<div class="card mt-4">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">Ringkasan Pesanan</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $statuses = ['Menunggu', 'Dikonfirmasi', 'DP', 'Lunas', 'Batal'];
                        @endphp
                        @foreach ($statuses as $status)
                            <tr>
                                <td>{{ $status }}</td>
                                <td>{{ $statusCounts[$status] ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <canvas id="orderStatusChart" class="chart-container"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Pesanan Terbaru -->
<div class="card mt-4">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Pesanan Terbaru</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Customer</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Struk</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentOrders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->customer->full_name }}</td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('cetak-struk', $order->order_id) }}" class="btn btn-primary btn-sm" target="_blank">Cetak Struk</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Ringkasan Pesan Kontak -->
<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Ringkasan Pesan Kontak</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr><th>Deskripsi</th><th>Jumlah</th></tr>
            </thead>
            <tbody>
                <tr><td>Total Pesan Kontak</td><td>{{ $messagesCount }}</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('orderStatusChart').getContext('2d');
    var orderStatusChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Menunggu', 'Dikonfirmasi', 'DP', 'Lunas', 'Batal'],
            datasets: [{
                data: [
                    {{ $statusCounts['Menunggu'] ?? 0 }},
                    {{ $statusCounts['Dikonfirmasi'] ?? 0 }},
                    {{ $statusCounts['DP'] ?? 0 }},
                    {{ $statusCounts['Lunas'] ?? 0 }},
                    {{ $statusCounts['Batal'] ?? 0 }}
                ],
                backgroundColor: ['#ffcc00', '#007bff', '#00bcd4', '#4caf50', '#f44336'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.raw + ' Pesanan';
                        }
                    }
                }
            },
            aspectRatio: 1.5
        }
    });
</script>

<style>
    .chart-container {
        max-width: 400px;
        height: 250px;
        margin: 0 auto;
    }
</style>
@endsection
