@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Tambah Pembayaran</h1>
    </div>

    <!-- Form untuk menambahkan pembayaran baru -->
    <form action="{{ route('pembayaran.store') }}" method="POST">
        @csrf

        {{-- Input: Order ID (select) --}}
        <div class="mb-3">
            <label for="order_id" class="form-label">No Order <span class="text-danger">*</span></label>
<select class="form-control @error('order_id') is-invalid @enderror"  
        id="order_id" name="order_id" required>
    <option value="">Pilih No Order</option> 
    @foreach ($orders as $order) 
        <option value="{{ $order->order_id }}"
            {{ old('order_id', $selectedOrderId) == $order->order_id ? 'selected' : '' }}>
            {{ $order->order_id }}
        </option>
    @endforeach
</select>
            @error('order_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Input: Tanggal Pembayaran --}}
        <div class="mb-3">
            <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror" 
                   name="tanggal_pembayaran" id="tanggal_pembayaran" 
                   value="{{ old('tanggal_pembayaran', date('Y-m-d')) }}" required>
            @error('tanggal_pembayaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Input: Jumlah Bayar --}}
        <input type="hidden" name="jenis_pembayaran" value="{{ $jenisPembayaran }}">

        <div class="mb-3">
            <label class="form-label">Jenis Pembayaran</label>
            <input type="text" class="form-control" value="{{ ucfirst($jenisPembayaran) }}" readonly>
        </div>

        {{-- Tombol --}}
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
