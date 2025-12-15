@extends('layouts.app')

@section('title', 'Detail Bukti Pembayaran')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-receipt me-2"></i>
                            Bukti Pembayaran - Order #{{ $pembayaran->order_id }}
                        </h5>
                    </div>
                    
                    <div class="card-body">
                        <!-- Informasi Dasar -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p><strong>ID Pembayaran:</strong> #{{ $pembayaran->id_pembayaran }}</p>
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Jumlah:</strong> <span class="text-success fw-bold">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</span></p>
                                <p><strong>Status Order:</strong> 
                                    <span class="badge 
                                        @if($pembayaran->order && $pembayaran->order->status == 'menunggu') bg-warning
                                        @elseif($pembayaran->order && $pembayaran->order->status == 'diproses') bg-info
                                        @elseif($pembayaran->order && $pembayaran->order->status == 'dikirim') bg-primary
                                        @elseif($pembayaran->order && $pembayaran->order->status == 'selesai') bg-success
                                        @elseif($pembayaran->order && $pembayaran->order->status == 'dibatalkan') bg-danger
                                        @else bg-secondary @endif">
                                        {{ $pembayaran->order->status ?? 'Tidak diketahui' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Bukti Bayar -->
                        <div class="text-center">
                            <h6 class="text-muted mb-3">Bukti Transfer Pembayaran</h6>
                            
                            @if($pembayaran->bukti_bayar)
                                <div class="mb-3">
                                    <img src="{{ asset($pembayaran->bukti_bayar) }}" 
                                         alt="Bukti Pembayaran" 
                                         class="img-fluid rounded shadow-sm"
                                         style="max-height: 500px; cursor: pointer;"
                                         onclick="openImageModal(this.src)">
                                </div>
                                
                                <div class="mt-3">
                                    <a href="{{ asset($pembayaran->bukti_bayar) }}" 
                                       download 
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-download me-1"></i> Download Gambar
                                    </a>
                                    <button class="btn btn-outline-secondary btn-sm" onclick="window.history.back()">
                                        <i class="fas fa-arrow-left me-1"></i> Kembali
                                    </button>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Tidak ada bukti pembayaran yang tersedia.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal untuk gambar besar -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Bukti Bayar" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 10px;
        border: none;
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    img {
        max-width: 100%;
        height: auto;
        border: 1px solid #dee2e6;
        border-radius: 8px;
    }
</style>
@endpush

@push('scripts')
<script>
    function openImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
        myModal.show();
    }
    
    // Fallback jika gambar tidak ditemukan
    document.addEventListener('DOMContentLoaded', function() {
        const img = document.querySelector('img[alt="Bukti Pembayaran"]');
        if (img) {
            img.onerror = function() {
                this.src = '{{ asset("img/no-image.png") }}';
                this.alt = 'Gambar tidak ditemukan';
            };
        }
    });
</script>
@endpush