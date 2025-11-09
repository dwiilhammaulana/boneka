@extends('layouts.app')

@section('title', 'Edit Pesan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Pesan</h1>
    </div>

    <!-- Form untuk mengedit pesan -->
    <form action="{{ route('contact_us.update', $contact->contact_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="first_name" class="form-label">Nama Depan</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                id="first_name" name="first_name" value="{{ old('first_name', $contact->first_name) }}" required>
            @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Nama Belakang</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                id="last_name" name="last_name" value="{{ old('last_name', $contact->last_name) }}" required>
            @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                id="email" name="email" value="{{ old('email', $contact->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label">Subjek</label>
            <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                id="subject" name="subject" value="{{ old('subject', $contact->subject) }}">
            @error('subject')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea class="form-control @error('message') is-invalid @enderror" 
                id="message" name="message" rows="4" required>{{ old('message', $contact->message) }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('contact_us.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
