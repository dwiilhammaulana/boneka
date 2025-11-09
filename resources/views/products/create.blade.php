@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h1 class="h3 mb-0">Tambah Produk</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" 
                                   id="product_name" name="product_name" value="{{ old('product_name') }}" required>
                            @error('product_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control @error('category_id') is-invalid @enderror" 
                                    id="category_id" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}" 
                                        {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                        id="stock" name="stock" value="1" readonly required
                                        style="background-color: #e9ecef; color: #495057; cursor: not-allowed;">
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="warna" class="form-label">Warna</label>
                            <input type="text" class="form-control @error('warna') is-invalid @enderror" 
                                   id="warna" name="warna" value="{{ old('warna') }}">
                            @error('warna')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <input type="number" class="form-control @error('tahun') is-invalid @enderror" 
                                           id="tahun" name="tahun" value="{{ old('tahun') }}" 
                                           min="1900" max="{{ date('Y') }}">
                                    @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kilometer" class="form-label">Kilometer</label>
                                    <input type="number" step="0.01" class="form-control @error('kilometer') is-invalid @enderror" 
                                           id="kilometer" name="kilometer" value="{{ old('kilometer') }}" min="0">
                                    @error('kilometer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">Upload Gambar Produk</h5>
                <div class="row">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <label for="image{{ $i === 1 ? '' : $i }}" class="form-label">
                                        Gambar Produk {{ $i }} {{ $i === 1 ? '(Utama)' : '' }}
                                    </label>
                                    <input type="file" class="form-control @error('image'.($i === 1 ? '' : $i)) is-invalid @enderror" 
                                           id="image{{ $i === 1 ? '' : $i }}" name="image{{ $i === 1 ? '' : $i }}" 
                                           accept="image/*">
                                    @error('image'.($i === 1 ? '' : $i))
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format: jpeg,png,jpg,gif,svg | Max: 2MB</small>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
@endsection