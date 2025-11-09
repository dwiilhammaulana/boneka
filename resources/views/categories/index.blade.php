@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Kategori</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Kategori</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)  <!-- Looping melalui masing-masing kategori -->
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('categories.show', $category->category_id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('categories.edit', $category->category_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('categories.destroy', $category->category_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
