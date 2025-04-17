<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .judul { text-align: center; font-size: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="judul">LAPORAN PENJUALAN</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total Harga</th>
                <th>Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualans as $index => $penjualan)
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
            @endforeach
        </tbody>
    </table>
</body>
</html>
