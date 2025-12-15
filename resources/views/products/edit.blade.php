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
                    <!-- Kiri -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="sku" name="sku" 
                                   value="{{ old('sku', $product->sku) }}">
                        </div>

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
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                                name="category_id" required>
                                <option value="">Pilih Kategori</option>
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
                                    <label for="price" class="form-label">Harga Awal <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" 
                                        value="{{ old('price', $product->price) }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discount" class="form-label">Diskon (%)</label>
                                    <input type="number" step="0.01" class="form-control @error('discount') is-invalid @enderror"
                                        id="discount" name="discount" 
                                        value="{{ old('discount', $product->discount) }}">
                                    @error('discount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual (Otomatis)</label>
                            <input type="number" step="0.01" class="form-control @error('harga_jual') is-invalid @enderror"
                                id="harga_jual" name="harga_jual" 
                                value="{{ old('harga_jual', $product->harga_jual) }}" readonly>
                            @error('harga_jual')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                id="stock" name="stock" 
                                value="{{ old('stock', $product->stock) }}" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dimensi & Berat -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="weight" class="form-label">Berat (gram)</label>
                                    <input type="number" class="form-control @error('weight') is-invalid @enderror"
                                        id="weight" name="weight" 
                                        value="{{ old('weight', $product->weight) }}">
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="shipping_cost_total" class="form-label">Biaya Kirim Total</label>
                                    <input type="number" step="0.01" class="form-control @error('shipping_cost_total') is-invalid @enderror"
                                        id="shipping_cost_total" name="shipping_cost_total" 
                                        value="{{ old('shipping_cost_total', $product->shipping_cost_total) }}">
                                    @error('shipping_cost_total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Dimensi -->
                        <h6 class="mt-3">Dimensi Produk</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="dimension_length" class="form-label">Panjang (cm)</label>
                                    <input type="number" step="0.01" class="form-control" 
                                           id="dimension_length" name="dimension_length" 
                                           value="{{ old('dimension_length', $product->dimension_length) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="dimension_width" class="form-label">Lebar (cm)</label>
                                    <input type="number" step="0.01" class="form-control" 
                                           id="dimension_width" name="dimension_width" 
                                           value="{{ old('dimension_width', $product->dimension_width) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="dimension_height" class="form-label">Tinggi (cm)</label>
                                    <input type="number" step="0.01" class="form-control" 
                                           id="dimension_height" name="dimension_height" 
                                           value="{{ old('dimension_height', $product->dimension_height) }}">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Kanan -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="6">{{ old('description', $product->description) }}</textarea>
                        </div>

                    </div>
                </div>

                <!-- Upload Gambar -->
                <h5 class="mt-4">Gambar Produk</h5>
                <div class="row">
                    @for ($i = 1; $i <= 5; $i++)
                        @php
                            $fieldName = $i === 1 ? 'image' : 'image_url'.$i;
                            $imageUrl = $i === 1 ? $product->image_url : $product->{'image_url'.$i};
                            $oldFieldName = $i === 1 ? 'image' : 'image'.$i;
                        @endphp
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                Gambar {{ $i }} {{ $i === 1 ? '(Utama)' : '' }}
                            </label>
                            <input type="file"
                                class="form-control @error($fieldName) is-invalid @enderror"
                                name="{{ $fieldName }}"
                                accept="image/*">

                            @error($fieldName)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Preview Gambar yang Ada -->
                            @if($imageUrl)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $imageUrl) }}" 
                                         class="img-thumbnail" 
                                         style="max-height: 100px; max-width: 100%;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" 
                                               id="remove_image{{ $i }}" 
                                               name="remove_image{{ $i }}" value="1">
                                        <label class="form-check-label text-danger" for="remove_image{{ $i }}">
                                            Hapus gambar ini
                                        </label>
                                    </div>
                                </div>
                            @endif
                            
                            <small class="text-muted">jpeg, png, jpg, gif, svg | max 2MB</small>
                        </div>
                    @endfor
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Produk</button>
                </div>

            </form>
        </div>
    </div>

    {{-- SCRIPT HITUNG DISKON OTOMATIS SAMA DENGAN CREATE --}}
    <script>
        function updateHargaJual() {
            let price = parseFloat(document.getElementById('price').value) || 0;
            let discount = parseFloat(document.getElementById('discount').value) || 0;

            let finalPrice = price - (price * discount / 100);
            document.getElementById('harga_jual').value = finalPrice > 0 ? finalPrice.toFixed(2) : 0;
        }

        // Inisialisasi saat load
        document.addEventListener('DOMContentLoaded', function() {
            updateHargaJual();
        });

        // Event listeners
        document.getElementById('price').addEventListener('input', updateHargaJual);
        document.getElementById('discount').addEventListener('input', updateHargaJual);
    </script>
@endsection