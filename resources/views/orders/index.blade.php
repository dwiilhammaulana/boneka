@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Pesanan</h1>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">Tambah Pesanan</a>
    </div>

    {{-- Notifikasi jika ada pesan info --}}
    @if(session('info'))
        <div class="alert alert-success" id="info-alert">
            {{ session('info') }}
        </div>
    @endif

    <!-- Table -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Pesanan</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Pesan</th>
                        <th>Total Harga</th>
                        <th>Sisa Angsuran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($orders as $order)
                        @if ($order->status !== 'Menunggu')
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $order->customer->username }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                                <td>{{ number_format($order->total_price, 2) }}</td>
                                <td>{{ number_format($order->sisa_tagihan, 2) }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('cetak-struk', $order->order_id) }}" class="btn btn-primary btn-sm" target="_blank">Cetak Struk</a>    
                                    <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    {{-- <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form> --}}
                                        @if ($order->sisa_tagihan > 0 && strtolower($order->status) !== 'lunas' && strtolower($order->status) !== 'batal')
                                            <a href="{{ route('pembayaran.create', ['order_id' => $order->order_id]) }}" class="btn btn-success btn-sm">Pembayaran</a>
                                        @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Script untuk auto-dismiss alert --}}
    <script>
        setTimeout(function () {
            let alert = document.getElementById('info-alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    </script>
@endsection
