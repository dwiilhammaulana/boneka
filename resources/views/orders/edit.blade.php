@extends('layouts.app')

@section('title', 'Edit Status Pesanan')

@section('content')
    <h1 class="h3">Edit Status Pesanan</h1>

    <form action="{{ route('orders.update', $order->order_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                @foreach (['Menunggu', 'Dikonfirmasi', 'DP', 'Lunas', 'Batal'] as $option)
                    <option value="{{ $option }}" {{ $order->status == $option ? 'selected' : '' }}>
                        {{ $option }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- KTP lama (gambar) --}}
        <div class="mb-3">
            <label class="form-label">KTP (Lama)</label>
            @if ($order->ktp && file_exists(public_path('uploads/ktp/' . $order->ktp)))
                <div class="mb-2">
                    <img src="{{ asset('uploads/ktp/' . $order->ktp) }}" alt="KTP" style="max-width: 300px;">
                </div>
            @else
                <p class="text-muted">Belum ada file KTP.</p>
            @endif
        </div>

        {{-- Upload file KTP baru --}}
        <div class="mb-3">
            <label for="ktp_file" class="form-label">Upload KTP Baru (opsional)</label>
            <input type="file" class="form-control" id="ktp_file" name="ktp_file" accept="image/*">
        </div>

        {{-- Status STNK --}}
        <div class="mb-3">
            <label for="stnk" class="form-label">Status STNK</label>
            <select class="form-control" id="stnk" name="stnk">
                @foreach (['pending', 'diproses', 'delivered', 'diterima'] as $option)
                    <option value="{{ $option }}" {{ $order->stnk == $option ? 'selected' : '' }}>
                        {{ ucfirst($option) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status BPKB --}}
        <div class="mb-3">
            <label for="bpkb" class="form-label">Status BPKB</label>
            <select class="form-control" id="bpkb" name="bpkb">
                @foreach (['pending', 'diproses', 'delivered', 'diterima'] as $option)
                    <option value="{{ $option }}" {{ $order->bpkb == $option ? 'selected' : '' }}>
                        {{ ucfirst($option) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status Logistik --}}
        <div class="mb-3">
            <label for="logistik" class="form-label">Status Logistik</label>
            <select class="form-control" id="logistik" name="logistik">
                @foreach (['request_pickup', 'pickup'] as $option)
                    <option value="{{ $option }}" {{ $order->logistik == $option ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $option)) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Sisa Tagihan --}}
        <div class="mb-3">
            <label for="sisa_tagihan" class="form-label">Sisa Tagihan</label>
            <input type="number" step="0.01" class="form-control" id="sisa_tagihan" name="sisa_tagihan"
                   value="{{ $order->sisa_tagihan }}" required>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
@endsection
