@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Kategori</h1>
    </div>

    <!-- Form untuk mengedit kategori -->
    <form action="{{ route('categories.update', $category->category_id) }}" method="POST">
        @csrf
        @method('PUT')  <!-- Menambahkan method PUT untuk update data -->

        <div class="mb-3">
            <label for="category_name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control @error('category_name') is-invalid @enderror" 
                id="category_name" name="category_name" value="{{ old('category_name', $category->category_name) }}" required>
            @error('category_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                id="description" name="description">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
