@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h1 class="h3 mb-0">Edit Produk</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" 
                                   id="product_name" name="product_name" 
                                   value="{{ old('product_name', $product->product_name) }}" required>
                            @error('product_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control @error('category_id') is-invalid @enderror" 
                                    id="category_id" name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}" 
                                        {{ old('category_id', $product->category_id) == $category->category_id ? 'selected' : '' }}>
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
                                           id="price" name="price" 
                                           value="{{ old('price', $product->price) }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                           id="stock" name="stock" 
                                           value="{{ old('stock', $product->stock) }}" required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="warna" class="form-label">Warna</label>
                            <input type="text" class="form-control @error('warna') is-invalid @enderror" 
                                   id="warna" name="warna" 
                                   value="{{ old('warna', $product->warna) }}">
                            @error('warna')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <input type="number" class="form-control @error('tahun') is-invalid @enderror" 
                                           id="tahun" name="tahun" 
                                           value="{{ old('tahun', $product->tahun) }}" 
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
                                           id="kilometer" name="kilometer" 
                                           value="{{ old('kilometer', $product->kilometer) }}" min="0">
                                    @error('kilometer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Image Upload Section -->
                <h5 class="mt-4 mb-3">Gambar Produk</h5>
                <div class="row">
                    @for($i = 1; $i <= 5; $i++)
                        @php
                            $fieldName = $i === 1 ? 'image' : 'image_url'.$i;
                            $imageUrl = $i === 1 ? $product->image_url : $product->{'image_url'.$i};
                        @endphp
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <label for="{{ $fieldName }}" class="form-label">
                                        Gambar {{ $i }} {{ $i === 1 ? '(Utama)' : '' }}
                                    </label>
                                    <input type="file" class="form-control @error($fieldName) is-invalid @enderror" 
                                           id="{{ $fieldName }}" name="{{ $fieldName }}" accept="image/*">
                                    @error($fieldName)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                    @if($imageUrl)
                                        <div class="mt-2 text-center">
                                            <img src="{{ asset('img/' . $imageUrl) }}" class="img-thumbnail" style="max-height: 100px;">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" 
                                                       id="remove_{{ $fieldName }}" name="remove_{{ $fieldName }}">
                                                <label class="form-check-label text-danger" for="remove_{{ $fieldName }}">
                                                    Hapus gambar ini
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                    <small class="text-muted d-block mt-1">Format: jpeg,png,jpg,gif,svg | Max: 2MB</small>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <!-- Status Field (for admin only) -->
                @if(auth()->guard('admin')->check())
                <div class="mb-3 col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="approved" {{ old('status', $product->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="pending" {{ old('status', $product->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endif

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection