@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Pembayaran</h1>
    </div>

    <!-- Form untuk mengedit data pembayaran -->
    <form action="{{ route('pembayaran.update', $pembayaran->id_pembayaran) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="order_id" class="form-label">Order ID</label>
            <select class="form-select @error('order_id') is-invalid @enderror" id="order_id" name="order_id" required>
                <option value="">-- Pilih Order --</option>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}" {{ $pembayaran->order_id == $order->id ? 'selected' : '' }}>
                        Order #{{ $order->id }}
                    </option>
                @endforeach
            </select>
            @error('order_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
            <input type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror" id="tanggal_pembayaran" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', $pembayaran->tanggal_pembayaran) }}" required>
            @error('tanggal_pembayaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jumlah_bayar" class="form-label">Jumlah Bayar (Rp)</label>
            <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror" id="jumlah_bayar" name="jumlah_bayar" step="0.01" min="0" value="{{ old('jumlah_bayar', $pembayaran->jumlah_bayar) }}" required>
            @error('jumlah_bayar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
