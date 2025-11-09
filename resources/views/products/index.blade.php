@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Produk</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
    </div>

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('products.index') }}">
                <div class="row">
                    <div class="col-md-4">
                        <label for="status" class="form-label">Filter Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="">Semua Status</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
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
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Dibuat Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->category->category_name }}</td>
                                <td>{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <span class="badge rounded-pill {{ $product->status == 'approved' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($product->creator)
                                        {{ $product->creator->name }} 
                                        <small class="text-muted">({{ class_basename($product->created_by_type) }})</small>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('products.show', $product->product_id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
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