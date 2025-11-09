@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <h1 class="h3">Detail Pesanan</h1>

    <div class="card position-relative">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detail Pesanan</h5>
        </div>

        <div class="card-body position-relative">
            {{-- Status Badge di pojok kanan atas card-body --}}
            @php
                $status = $order->status;
                $badgeClass = match($status) {
                    'Belum Bayar' => 'badge bg-danger',
                    'Dalam Proses' => 'badge bg-warning text-dark',
                    'Selesai' => 'badge bg-success',
                    default => 'badge bg-secondary',
                };
            @endphp
            <span style="position: absolute; top: 1rem; right: 1rem; font-size: 1.25rem; padding: 0.5em 1em;" class="{{ $badgeClass }}">
                {{ $status }}
            </span>

            <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
            <p><strong>Nama Pelanggan:</strong> {{ $order->customer->full_name }}</p>
            <p><strong>Tanggal Pesanan:</strong> {{ $order->order_date }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 2) }}</p>

            <h5 class="mt-4">Detail Produk</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->product_name ?? 'Produk tidak ditemukan' }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>Rp {{ number_format($detail->price, 2) }}</td>
                            <td>Rp {{ number_format($detail->quantity * $detail->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h5 class="mt-5">Mutasi Angsuran</h5>
            @if($order->pembayaran->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Jumlah Bayar (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalBayar = 0;
                        @endphp
                        @foreach ($order->pembayaran as $index => $bayar)
                            @php
                                $totalBayar += $bayar->jumlah_bayar;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($bayar->tanggal_pembayaran)->format('d/m/Y') }}</td>
                                <td>Rp {{ number_format($bayar->jumlah_bayar, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2" class="text-end">Total Angsuran</th>
                            <th>Rp {{ number_format($totalBayar, 2) }}</th>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-end">Sisa Tagihan</th>
                            <th>Rp {{ number_format($order->sisa_tagihan, 2) }}</th>
                        </tr>
                    </tbody>
                </table>
            @else
                <p class="text-muted">Belum ada pembayaran untuk pesanan ini.</p>
                <p><strong>Sisa Tagihan:</strong> Rp {{ number_format($order->sisa_tagihan, 2) }}</p>
            @endif

            <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
@endsection
