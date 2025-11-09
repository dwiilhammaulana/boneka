@extends('layouts.app')

@section('title', 'Detail Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detail Admin</h1>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali ke Daftar Admin</a>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detail Admin: {{ $admin->username }}</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Username:</strong> {{ $admin->username }}
            </div>
            <div class="mb-3">
                <strong>Email:</strong> {{ $admin->email ?? '-' }}
            </div>
            <div class="mb-3">
                <strong>Nama Lengkap:</strong> {{ $admin->full_name ?? '-' }}
            </div>
            <div class="mb-3">
                <strong>Nomor Telepon:</strong> {{ $admin->phone_number ?? '-' }}
            </div>
            <!-- Jika Anda ingin menambahkan tanggal pembuatan atau lainnya -->
            <div class="mb-3">
                <strong>Tanggal Dibuat:</strong> {{ $admin->created_at->format('d M Y') }}
            </div>
        </div>

        <div class="card-footer">
            <!-- Tombol Edit -->
            <a href="{{ route('admin.edit', $admin->admin_id) }}" class="btn btn-warning">Edit Admin</a>
        </div>
    </div>
@endsection
