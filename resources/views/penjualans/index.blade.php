@extends('layouts.app')

@section('title', 'Daftar Penjualan')

@section('content')
<div class="container">
    <h1>Daftar Penjualan</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPenjualanModal">Tambah Penjualan</button>

    <form method="GET" action="{{ route('penjualans.index') }}">
    <input type="text" name="search" placeholder="Cari berdasarkan pelanggan..." value="{{ request('search') }}">
    <button type="submit">Cari</button>
    </form>

    <table class="table">
        <thead>
        <tr class="text-center">
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Tanggal Penjualan</th>
                <th>Total Harga</th>
                <th>Member</th>
                <th>Produk</th>
                <th>Jumlah Produk</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualans as $penjualan)
            <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $penjualan->Kode_Transaksi }}</td> 
                    <td>{{ $penjualan->Tanggal_Penjualan }}</td>
                    <td>{{ number_format($penjualan->Total_Harga, 0, ',', '.') }}</td>
                    <td>
                        @if($penjualan->pelanggans && $penjualan->pelanggans->Nama_pelanggan)
                            {{ $penjualan->pelanggans->Nama_pelanggan }}
                        @else
                            Tidak ada member
                        @endif
                    </td>
                    <td>
                        @foreach ($penjualan->detail_penjualans as $detail)
                            <p>{{ $detail->produk->Nama_Produk }}</p>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($penjualan->detail_penjualans as $detail)
                            <p>{{ $detail->Jumlah_produk }}</p>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($penjualan->detail_penjualans as $detail)
                            <p>{{ number_format($detail->Subtotal, 0, ',', '.') }}</p>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('penjualans.print', $penjualan->PenjualanID) }}" class="btn btn-secondary" target="_blank">Cetak</a>
                        <form action="{{ route('penjualans.destroy', $penjualan->PenjualanID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus penjualan ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $penjualans->links() }}
</div>

<!-- Modal Tambah Penjualan -->
<div class="modal fade" id="addPenjualanModal" tabindex="-1" aria-labelledby="addPenjualanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Menambahkan modal-lg untuk ukuran lebih besar -->
        <div class="modal-content">
            <form action="{{ route('penjualans.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="addPenjualanModalLabel">Tambah Penjualan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Menampilkan notifikasi jika ada success, error, atau error validation -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Pilihan Member -->
                    <div class="mb-3">
                        <label for="PelangganID" class="form-label">Member (Opsional)</label>
                        <select name="PelangganID" class="form-control" id="PelangganID">
                            <option value="">Pilih member</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->PelangganID }}">{{ $pelanggan->Nama_pelanggan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Penjualan -->
                    <div class="mb-3">
                        <label for="Tanggal_Penjualan" class="form-label">Tanggal Penjualan (Opsional)</label>
                        <input type="date" class="form-control" id="Tanggal_Penjualan" name="Tanggal_Penjualan">
                        <small class="text-muted">Kosongkan jika ingin menggunakan tanggal hari ini.</small>
                    </div>

                    <!-- Daftar Produk -->
                    <div id="produk-list">
                        <div class="produk-item mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Produk</label>
                                    <select name="produk[0][ProdukID]" class="form-control produk-select">
                                        <option value="">Pilih produk</option>
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->ProdukID }}" data-harga="{{ $produk->Harga }}">
                                                {{ $produk->Nama_Produk }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Jumlah</label>
                                    <input type="number" name="produk[0][Jumlah_produk]" class="form-control jumlah-input" min="1">
                                </div>
                                <div class="col-md-2">
                                    <label>Subtotal</label>
                                    <input type="text" name="produk[0][Subtotal]" class="form-control subtotal-input" readonly>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-produk">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Tambah Produk -->
                    <button type="button" class="btn btn-secondary" id="add-produk">Tambah Produk</button>

                    <!-- Total Harga -->
                    <div class="mb-3 mt-3">
                        <label for="Total_Harga" class="form-label">Total Harga</label>
                        <input type="text" class="form-control" id="Total_Harga" name="Total_Harga" readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let produkIndex = 1;  // Inisialisasi produkIndex

    // Fungsi untuk menambah produk
    $("#add-produk").click(function() {
        // Menambahkan produk baru ke dalam form
        let newProduk = `
            <div class="produk-item mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <label>Produk</label>
                        <select name="produk[${produkIndex}][ProdukID]" class="form-control produk-select">
                            <option value="">Pilih produk</option>
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->ProdukID }}" data-harga="{{ $produk->Harga }}">
                                    {{ $produk->Nama_Produk }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Jumlah</label>
                        <input type="number" name="produk[${produkIndex}][Jumlah_produk]" class="form-control jumlah-input" min="1">
                    </div>
                    <div class="col-md-2">
                        <label>Subtotal</label>
                        <input type="text" name="produk[${produkIndex}][Subtotal]" class="form-control subtotal-input" readonly>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-produk">Hapus</button>
                    </div>
                </div>
            </div>
        `;
        // Menambahkan produk baru ke dalam daftar produk
        $("#produk-list").append(newProduk);
        produkIndex++;  // Meningkatkan produkIndex agar produk berikutnya memiliki index yang benar

        // Pasang event handler untuk produk baru
        $(".produk-item:last .produk-select, .produk-item:last .jumlah-input").on('change', function() {
            updateSubtotal($(this).closest(".produk-item"));
        });

        // Update total harga
        updateTotalHarga();
    });

    // Fungsi untuk menghapus produk
    $(document).on("click", ".remove-produk", function() {
        if ($(".produk-item").length > 1) {
            $(this).closest(".produk-item").remove();
            updateTotalHarga();
        }
    });

    // Hitung subtotal & total harga saat ada perubahan pada produk atau jumlah
    $(document).on("change", ".produk-select, .jumlah-input", function() {
        let row = $(this).closest(".produk-item");
        updateSubtotal(row);
    });

    // Fungsi untuk menghitung subtotal
    function updateSubtotal(row) {
        let harga = row.find(".produk-select option:selected").data("harga") || 0;
        let jumlah = row.find(".jumlah-input").val() || 0;
        let subtotal = harga * jumlah;
        row.find(".subtotal-input").val(subtotal.toFixed(2));
        updateTotalHarga();  // Update total harga setelah subtotal dihitung
    }

    // Fungsi untuk update total harga
    function updateTotalHarga() {
        let total = 0;
        $(".subtotal-input").each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        $("#Total_Harga").val(total.toFixed(2));
    }
});
</script>

@endsection
