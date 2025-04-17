@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Laporan Penjualan</h2>

    {{-- Form filter tanggal --}}
    <form action="{{ route('laporan.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
        </div>
        <div class="col-md-4">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    {{-- Tombol cetak PDF --}}
    <form action="{{ route('laporan.cetak') }}" method="GET" target="_blank" class="mb-3">
        <input type="hidden" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
        <input type="hidden" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-file-pdf me-1"></i> Cetak PDF
        </button>
    </form>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total Harga</th>
                <th>Produk</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penjualans as $index => $penjualan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $penjualan->Tanggal_Penjualan }}</td>
                    <td>{{ optional($penjualan->pelanggans)->Nama_pelanggan ?? 'Umum' }}</td>
                    <td>Rp {{ number_format($penjualan->Total_Harga, 0, ',', '.') }}</td>
                    <td>
                        @foreach($penjualan->detail_penjualans as $detail)
                            {{ $detail->produk->Nama_Produk }} ({{ $detail->Jumlah_produk }})<br>
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data penjualan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
