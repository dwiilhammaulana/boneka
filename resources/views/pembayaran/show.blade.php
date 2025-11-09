@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
    <div class="container px-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">🧾 Detail Pembayaran</h1>
            <a href="{{ route('pembayaran.index') }}" class="btn btn-outline-secondary">← Kembali</a>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-gradient bg-primary text-white py-3 px-4">
                <h5 class="mb-0">Pembayaran ID: #{{ $pembayaran->id_pembayaran }}</h5>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="border-start ps-3">
                            <h6 class="text-muted">Order ID</h6>
                            <p class="fs-5 fw-semibold mb-0">{{ $pembayaran->order_id }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border-start ps-3">
                            <h6 class="text-muted">Tanggal Pembayaran</h6>
                            <p class="fs-5 fw-semibold mb-0">
                                {{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border-start ps-3">
                            <h6 class="text-muted">Jumlah Bayar</h6>
                            <p class="fs-5 fw-semibold text-success mb-0">
                                Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border-start ps-3">
                            <h6 class="text-muted">Metode Pembayaran</h6>
                            <p class="fs-5 fw-semibold text-capitalize mb-0">
                                {{ $pembayaran->metode }}
                            </p>
                        </div>
                    </div>
                </div>

                @if ($pembayaran->metode === 'transfer' && $pembayaran->bukti_bayar)
                    <hr class="my-4">
                    <div class="text-center">
                        <h6 class="text-muted mb-3">Bukti Pembayaran</h6>
                        <img src="{{ asset('storage/bukti_bayar/' . $pembayaran->bukti_bayar) }}"
                             alt="Bukti Bayar"
                             class="img-fluid rounded-3 shadow-sm"
                             style="max-width: 400px; cursor: pointer;"
                             data-bs-toggle="modal"
                             data-bs-target="#modalBukti">
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalBukti" tabindex="-1" aria-labelledby="modalLabelBukti" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content bg-white rounded-4">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title" id="modalLabelBukti">Bukti Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/bukti_bayar/' . $pembayaran->bukti_bayar) }}"
                                         alt="Bukti Bayar Besar"
                                         class="img-fluid rounded shadow-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
