@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .print-area, .print-area * {
            visibility: visible;
        }

        .print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .no-print {
            display: none !important;
        }
    }
</style>

<div class="container">

    {{-- Form filter (hanya tampil di layar) --}}
    <form method="GET" class="row g-3 mb-4 no-print">
        <div class="col-md-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label>Bulan</label>
            <input type="number" name="bulan" value="{{ request('bulan') }}" class="form-control" placeholder="1-12">
        </div>
        <div class="col-md-3">
            <label>Tahun</label>
            <input type="number" name="tahun" value="{{ request('tahun') }}" class="form-control" placeholder="2025">
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    @if($dataPenjualan->isEmpty())
        <div class="alert alert-info no-print">Belum ada data penjualan lunas.</div>
    @else
        <div class="print-area">
            {{-- Judul cetak --}}
            <h3 class="text-center mb-3">Laporan Penjualan (Status: Lunas)</h3>

            {{-- Info Filter yang digunakan --}}
            <p><strong>Filter Tanggal:</strong> 
                @if(request('tanggal'))
                    {{ \Carbon\Carbon::parse(request('tanggal'))->format('d M Y') }}
                @elseif(request('bulan') && request('tahun'))
                    Bulan {{ request('bulan') }} Tahun {{ request('tahun') }}
                @elseif(request('tahun'))
                    Tahun {{ request('tahun') }}
                @else
                    Semua Data
                @endif
            </p>

            {{-- Tabel --}}
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>ID Pesanan</th>
                        <th>Nama Pelanggan</th>
                        <th class="text-end">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPenjualan as $row)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($row->order_date)->format('d M Y') }}</td>
                            <td>{{ $row->order_id }}</td>
                            <td>{{ $row->full_name }}</td>
                            <td class="text-end">Rp {{ number_format($row->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-success fw-bold">
                        <td colspan="3" class="text-end">Total Penjualan:</td>
                        <td class="text-end">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endif

    {{-- Tombol Cetak --}}
    <div class="text-end mt-4 no-print">
        <button type="button" onclick="window.print()" class="btn btn-success">Cetak Laporan</button>
    </div>
</div>
@endsection
