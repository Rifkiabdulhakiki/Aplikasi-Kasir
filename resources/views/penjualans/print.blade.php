<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 300px;
            margin: auto;
            text-align: left;
            padding: 10px;
        }

        .struk {
            border: 1px solid #000;
            padding: 10px;
            font-size: 12px;
        }

        .btn-print {
            display: none; /* Menyembunyikan tombol cetak saat mencetak */
        }

        @media print {
            .btn-print {
                display: none; /* Sembunyikan tombol cetak saat print */
            }

            .struk {
                padding-bottom: 10px;
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .total {
            margin-top: 10px;
        }

        hr {
            border-top: 1px dashed #ccc;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="struk">
        <h2>E-Kasir</h2>
        <p><strong>Kode Transaksi:</strong> {{ $penjualan->Kode_Transaksi }}</p>
        <p><strong>Tanggal:</strong> {{ $penjualan->Tanggal_Penjualan }}</p>
        <p><strong>Member:</strong> {{ $penjualan->pelanggans->Nama_pelanggan ?? 'Non Member' }}</p>

        <hr>

        <table style="width: 100%; text-align: left;">
            <tr>
                <th>Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
            @foreach($penjualan->detail_penjualans as $detail)
                <tr>
                    <td>{{ $detail->produk->Nama_Produk }}</td>
                    <td>Rp{{ number_format($detail->produk->Harga, 0, ',', '.') }}</td>
                    <td>{{ $detail->Jumlah_produk }}</td>
                    <td>Rp{{ number_format($detail->Subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>

        <hr>

        <div class="total">
            <p><strong>Total Harga:</strong> Rp{{ number_format($penjualan->Total_Harga, 0, ',', '.') }}</p>
        </div>

        <hr>
        <p>Terima kasih telah berbelanja!</p>

        <button onclick="window.print()" class="btn-print">Cetak</button>
    </div>

</body>
</html>
