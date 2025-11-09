@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    <h1 class="h3">Detail Produk</h1>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detail Produk</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama Produk:</strong> {{ $product->product_name }}</p>
            <p><strong>Kategori:</strong> {{ optional($product->category)->category_name ?? 'Tidak ada kategori' }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($product->price, 2) }}</p>
            <p><strong>Stok:</strong> {{ $product->stock }}</p>
            <p><strong>Deskripsi:</strong> {{ $product->description }}</p>

            @if($product->image_url)
                <p><strong>Gambar:</strong><br>
                    <img src="{{ asset('img/' . $product->image_url) }}" alt="Gambar Produk" class="img-fluid" width="200">
                </p>
            @endif

            @if($product->image_url2)
                <p><strong>Gambar Tambahan:</strong><br>
                    <img src="{{ asset('img/' . $product->image_url2) }}" alt="Gambar Produk Tambahan" class="img-fluid" width="200">
                </p>
            @endif

            <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection