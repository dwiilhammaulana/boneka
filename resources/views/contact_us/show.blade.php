@extends('layouts.app')

@section('title', 'Detail Pesan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detail Pesan</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama Lengkap:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Subjek:</strong> {{ $contact->subject }}</p>
            <p><strong>Pesan:</strong> {{ $contact->message }}</p>
            <p><strong>Tanggal Kirim:</strong> {{ $contact->created_at->format('d-m-Y H:i') }}</p>
            
            <a href="{{ route('contact_us.index') }}" class="btn btn-secondary">Kembali ke Daftar Pesan</a>
        </div>
    </div>
@endsection
