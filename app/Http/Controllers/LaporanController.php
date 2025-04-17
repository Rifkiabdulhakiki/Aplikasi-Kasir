<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal dari request
        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');

        // Query awal
        $query = Penjualan::with('pelanggans', 'detail_penjualans.produk')->orderBy('created_at', 'desc');

        // Filter jika tanggal tersedia
        if ($tanggal_mulai && $tanggal_selesai) {
            $query->whereDate('created_at', '>=', $tanggal_mulai)
                  ->whereDate('created_at', '<=', $tanggal_selesai);
        }

        $penjualans = $query->get();

        return view('laporan.index', compact('penjualans', 'tanggal_mulai', 'tanggal_selesai'));
    }

    public function cetakPDF(Request $request)
    {
        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');

        $query = Penjualan::with('pelanggans', 'detail_penjualans.produk')->orderBy('created_at', 'desc');

        if ($tanggal_mulai && $tanggal_selesai) {
            $query->whereDate('created_at', '>=', $tanggal_mulai)
                  ->whereDate('created_at', '<=', $tanggal_selesai);
        }

        $penjualans = $query->get();

        $html = View::make('laporan.cetak', compact('penjualans', 'tanggal_mulai', 'tanggal_selesai'))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('Laporan_Penjualan.pdf', 'D');
    }
}
