@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Customer</h1>
    </div>

    <!-- Form untuk mengedit customer -->
    <form action="{{ route('customers.update', $customer->customer_id) }}" method="POST">
        @csrf
        @method('PUT')  <!-- Menambahkan method PUT untuk update data -->

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" 
                id="username" name="username" value="{{ old('username', $customer->username) }}" required>
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                id="email" name="email" value="{{ old('email', $customer->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="full_name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                id="full_name" name="full_name" value="{{ old('full_name', $customer->full_name) }}" required>
            @error('full_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                id="phone_number" name="phone_number" value="{{ old('phone_number', $customer->phone_number) }}" required>
            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea class="form-control @error('address') is-invalid @enderror" 
                id="address" name="address" rows="3" required>{{ old('address', $customer->address) }}</textarea>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
