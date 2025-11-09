<!-- resources/views/contact_us/index.blade.php -->
@extends('layouts.app')

@section('title', 'Daftar Pesan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Pesan</h1>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Pesan</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Subjek</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)  <!-- Looping melalui masing-masing kontak -->
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ Str::limit($contact->message, 50) }}</td>
                            <td>{{ $contact->created_at->format('d-m-Y') }}</td>
                            <td>
                                <!-- Detail Button -->
                                <a href="{{ route('contact_us.show', $contact->contact_id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('contact_us.edit', $contact->contact_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <!-- Delete Button (using a form for DELETE method) -->
                                <form action="{{ route('contact_us.destroy', $contact->contact_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pesan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
