@extends('layouts.app')

@section('title', 'Mobil yang Dijual Customer')

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
    {{-- Form Filter --}}
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
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    @if($products->isEmpty())
        <div class="alert alert-warning no-print">Tidak ada mobil yang dijual customer pada periode ini.</div>
    @else
        <div class="print-area">
            <h3 class="text-center mb-3">Laporan Mobil yang Dijual Customer</h3>

            {{-- Info Filter --}}
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

            {{-- Tabel Data --}}
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Tanggal Beli</th>
                        <th>Nama Mobil</th>
                        <th>Merek</th>        
                        <th class="text-end">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalHarga = 0; @endphp
                    @foreach ($products as $m)
                        @php $totalHarga += $m->price; @endphp
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($m->created_at)->format('d M Y') }}</td>
                            <td>{{ $m->product_name }}</td>
                            <td>{{ $m->category_name }}</td>
                            <td class="text-end">Rp {{ number_format($m->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-success fw-bold">
                        <td colspan="3" class="text-end">Total Harga Mobil:</td>
                        <td class="text-end">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
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
