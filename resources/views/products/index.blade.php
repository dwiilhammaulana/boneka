@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Produk</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Produk</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>SKU</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $product->sku ?? '-' }}</td>

                                <td>{{ $product->product_name }}</td>

                                <td>
                                    {{ optional($product->category)->category_name ?? '-' }}
                                </td>

                                <td>Rp {{ number_format($product->price, 2) }}</td>

                                <td>
                                    @if($product->harga_jual)
                                        Rp {{ number_format($product->harga_jual, 2) }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>{{ $product->stock }}</td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('products.show', $product->product_id) }}" 
                                           class="btn btn-info btn-sm">Detail</a>

                                        <a href="{{ route('products.edit', $product->product_id) }}" 
                                           class="btn btn-warning btn-sm">Edit</a>

                                        <form action="{{ route('products.destroy', $product->product_id) }}" 
                                              method="POST" 
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>
@endsection
