@extends('layouts.app')

@section('title', 'Pembayaran Saya')

@section('content')
    @php
        $order = $orders->firstWhere('order_id', $selectedOrderId);
    @endphp

    @if($order)
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Pembayaran</h1>
        </div>

        <form action="{{ route('pembayaran.store') }}" method="POST">
            @csrf

            <input type="hidden" name="order_id" value="{{ $order->order_id }}">

            <div class="mb-3">
                <label class="form-label">No Order</label>
                <input type="text" class="form-control" value="{{ $order->order_id }}" readonly>
            </div>

            <div class="mb-3">
                <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran <span class="text-danger">*</span></label>
                <input type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror" 
                       name="tanggal_pembayaran" id="tanggal_pembayaran" 
                       value="{{ old('tanggal_pembayaran', date('Y-m-d')) }}" required>
                @error('tanggal_pembayaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <input type="hidden" name="jenis_pembayaran" value="{{ $jenisPembayaran }}">

            <div class="mb-3">
                <label class="form-label">Jenis Pembayaran</label>
                <input type="text" class="form-control" value="{{ ucfirst($jenisPembayaran) }}" readonly>
            </div>

            @if(isset($order->total_harga))
                <div class="mb-3">
                    <label class="form-label">Jumlah Bayar</label>
                    <input type="text" class="form-control" value="Rp {{ number_format($order->total_harga, 0, ',', '.') }}" readonly>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Kirim Pembayaran</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    @else
        <div class="alert alert-danger">
            Data order tidak ditemukan.
        </div>
    @endif
@endsection
