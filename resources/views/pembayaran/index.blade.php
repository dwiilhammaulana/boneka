@extends('layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Daftar Pembayaran</h1>
    <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">Tambah Pembayaran</a>
</div>

<!-- Tabel -->
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Data Pembayaran</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Jumlah Bayar</th>
                        <th>Metode</th>
                        <th class="text-center">Bukti Bayar</th>
                        <th class="text-center">Aksi</th>   
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayaran as $pembayaran)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pembayaran->order_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($pembayaran->metode) }}</td>
                        <td class="text-center">
                            @if ($pembayaran->metode === 'transfer' && $pembayaran->bukti_bayar)
                                <img src="{{ asset('storage/bukti_bayar/' . $pembayaran->bukti_bayar) }}"
                                     alt="Bukti Bayar"
                                     style="max-width: 100px; cursor: pointer; border-radius: 6px;"
                                     data-bs-toggle="modal"
                                     data-bs-target="#modalBukti{{ $loop->iteration }}">
                                
                                <!-- Modal -->
                                <div class="modal fade" id="modalBukti{{ $loop->iteration }}" tabindex="-1" aria-labelledby="modalLabel{{ $loop->iteration }}" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $loop->iteration }}">Bukti Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body text-center">
                                        <img src="{{ asset('storage/bukti_bayar/' . $pembayaran->bukti_bayar) }}"
                                             alt="Bukti Bayar Besar"
                                             class="img-fluid rounded shadow">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            @else
                                Tidak ada
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pembayaran.show', $pembayaran->id_pembayaran) }}" class="btn btn-info btn-sm">Detail</a>
                            {{-- <a href="{{ route('pembayaran.edit', $pembayaran->id_pembayaran) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pembayaran.destroy', $pembayaran->id_pembayaran) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button> --}}
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
