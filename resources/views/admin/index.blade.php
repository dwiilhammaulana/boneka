@extends('layouts.app')

@section('title', 'Daftar Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Admin</h1>
        <a href="{{ route('admin.create') }}" class="btn btn-primary">Tambah Admin</a>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Admin</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Nama Lengkap</th>
                        <th>Nomor Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($admins as $admin)  <!-- Looping melalui masing-masing admin -->
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->full_name }}</td>
                        <td>{{ $admin->phone_number }}</td>
                        <td>
                            <!-- Tombol untuk melihat detail admin -->
                            <a href="{{ route('admin.show', $admin->admin_id) }}" class="btn btn-info btn-sm">Detail</a>
                            <!-- Tombol untuk mengedit admin -->
                            <a href="{{ route('admin.edit', $admin->admin_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <!-- Form untuk menghapus admin -->
                            <form action="{{ route('admin.destroy', $admin->admin_id) }}" method="POST" style="display:inline;">
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
