<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\KontrakSewa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKamar = Kamar::count();
        $kamarTersedia = Kamar::where('status', 'tersedia')->count();
        $kamarTerisi = Kamar::where('status', 'terisi')->count();
        
        // Total pendapatan bulan ini
        $bulanIni = date('m');
        $tahunIni = date('Y');
        $totalPendapatanBulanIni = Pembayaran::where('bulan', $bulanIni)
            ->where('tahun', $tahunIni)
            ->where('status', 'lunas')
            ->sum('jumlah_bayar');
        
        // Jumlah pembayaran tertunggak
        $pembayaranTertunggak = Pembayaran::where('status', 'tertunggak')->count();
        
        // Total penyewa
        $totalPenyewa = Penyewa::count();
        
        // Total kontrak aktif
        $kontrakAktif = KontrakSewa::where('status', 'aktif')->count();
        
        // Data untuk chart - revenue per bulan
        $revenuePerBulan = [];
        for ($i = 11; $i >= 0; $i--) {
            $bulan = date('m', strtotime("-$i months"));
            $tahun = date('Y', strtotime("-$i months"));
            $revenue = Pembayaran::where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->where('status', 'lunas')
                ->sum('jumlah_bayar');
            $revenuePerBulan[$i] = $revenue;
        }
        
        // Status kamar chart
        $statusKamarData = [
            'tersedia' => $kamarTersedia,
            'terisi' => $kamarTerisi,
        ];
        
        // Top pembayaran tertunggak
        $topTertunggak = Pembayaran::where('status', 'tertunggak')
            ->with('kontrakSewa.penyewa')
            ->limit(5)
            ->get();
        
        return view('dashboard.index', compact(
            'totalKamar',
            'kamarTersedia',
            'kamarTerisi',
            'totalPendapatanBulanIni',
            'pembayaranTertunggak',
            'totalPenyewa',
            'kontrakAktif',
            'revenuePerBulan',
            'statusKamarData',
            'topTertunggak',
        ));
    }
}
