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
                    <!-- Kiri -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku') }}">
                        </div>

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
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                                name="category_id" required>
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
                                    <label for="price" class="form-label">Harga Awal <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discount" class="form-label">Diskon (%)</label>
                                    <input type="number" class="form-control @error('discount') is-invalid @enderror"
                                        id="discount" name="discount" value="{{ old('discount') }}">
                                    @error('discount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual (Otomatis)</label>
                            <input type="number" class="form-control @error('harga_jual') is-invalid @enderror"
                                id="harga_jual" name="harga_jual" value="{{ old('harga_jual') }}" readonly>
                            @error('harga_jual')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                id="stock" name="stock" value="{{ old('stock', 1) }}" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Kanan -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        </div>

                    </div>
                </div>

                <!-- Upload Gambar -->
                <h5 class="mt-4">Upload Gambar Produk</h5>
                <div class="row">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                Gambar {{ $i }} {{ $i === 1 ? '(Utama)' : '' }}
                            </label>
                            <input type="file"
                                class="form-control @error('image' . ($i === 1 ? '' : $i)) is-invalid @enderror"
                                name="image{{ $i === 1 ? '' : $i }}"
                                accept="image/*">

                            @error('image' . ($i === 1 ? '' : $i))
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">jpeg, png, jpg, gif, svg | max 2MB</small>
                        </div>
                    @endfor
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Produk</button>
                </div>

            </form>
        </div>
    </div>

    {{-- SCRIPT HITUNG DISKON OTOMATIS --}}
    <script>
        function updateHargaJual() {
            let price = parseFloat(document.getElementById('price').value) || 0;
            let discount = parseFloat(document.getElementById('discount').value) || 0;

            let finalPrice = price - (price * discount / 100);
            document.getElementById('harga_jual').value = finalPrice > 0 ? finalPrice : 0;
        }

        document.getElementById('price').addEventListener('input', updateHargaJual);
        document.getElementById('discount').addEventListener('input', updateHargaJual);
    </script>
@endsection
