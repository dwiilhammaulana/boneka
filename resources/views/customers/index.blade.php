@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Pelanggan</h1>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">Tambah Pelanggan</a>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Pelanggan</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($customers as $customer) <!-- Looping melalui masing-masing pelanggan -->
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->username }}</td>
                        <td>{{ $customer->full_name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            <a href="{{ route('customers.show', $customer->customer_id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" style="display:inline;">
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
