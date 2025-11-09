@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detail Kategori</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali ke Daftar Kategori</a>
    </div>

    <!-- Tampilkan detail kategori -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detail Kategori: {{ $category->category_name }}</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Nama Kategori:</strong> {{ $category->category_name }}
            </div>
            <div class="mb-3">
                <strong>Deskripsi:</strong> {{ $category->description ?? '-' }}
            </div>
        </div>
    </div>
@endsection
