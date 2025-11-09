@extends('layouts.app')

@section('title', 'Detail Customer')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detail Customer</h1>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali ke Daftar Customer</a>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detail Customer: {{ $customer->username }}</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Username:</strong> {{ $customer->username }}
            </div>
            <div class="mb-3">
                <strong>Email:</strong> {{ $customer->email ?? '-' }}
            </div>
            <div class="mb-3">
                <strong>Nama Lengkap:</strong> {{ $customer->full_name ?? '-' }}
            </div>
            <div class="mb-3">
                <strong>Nomor Telepon:</strong> {{ $customer->phone_number ?? '-' }}
            </div>
            <div class="mb-3">
                <strong>Alamat:</strong> {{ $customer->address ?? '-' }}
            </div>
            <div class="mb-3">
                <strong>Tanggal Dibuat:</strong> {{ $customer->created_at->format('d M Y') }}
            </div>
        </div>

        <div class="card-footer">
            <!-- Tombol Edit -->
            <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-warning">Edit Customer</a>
        </div>
    </div>
@endsection
