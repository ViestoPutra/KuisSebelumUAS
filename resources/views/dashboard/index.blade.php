@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .stat-card { background-color: white; border-radius: 6px; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 1rem; }
    .stat-card h3 { color: #666; font-size: 0.875rem; margin-bottom: 0.5rem; }
    .stat-card .number { font-size: 1.875rem; font-weight: bold; color: #333; }
    .stat-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
    .card { background-color: white; border-radius: 6px; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem; }
    .card h3 { font-size: 1.125rem; font-weight: 600; color: #333; margin-bottom: 1rem; }
    .card table { width: 100%; border-collapse: collapse; }
    .card table th { text-align: left; padding: 0.5rem 0; border-bottom: 1px solid #eee; color: #666; font-size: 0.875rem; }
    .card table td { padding: 0.75rem 0; border-bottom: 1px solid #f0f0f0; }
    .quick-actions { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; }
    .action-btn { background-color: #f0f0f0; border: 1px solid #ddd; border-radius: 6px; padding: 1rem; text-align: center; text-decoration: none; color: #333; transition: background-color 0.2s; }
    .action-btn:hover { background-color: #e8e8e8; }
    .action-btn i { font-size: 1.5rem; display: block; margin-bottom: 0.5rem; }
    .action-btn span { font-size: 0.875rem; font-weight: 500; }
    .empty-msg { text-align: center; color: #999; padding: 2rem 0; }
</style>

<div>
    <h1 style="font-size: 2rem; font-weight: bold; color: #333; margin-bottom: 0.5rem;">Dashboard</h1>
    <p style="color: #666; margin-bottom: 2rem;">Selamat datang di Sistem Manajemen Kost-Kostan</p>

    <!-- Statistics Cards -->
    <div class="stat-cards">
        <div class="stat-card">
            <h3>Total Kamar</h3>
            <div class="number">{{ $totalKamar }}</div>
        </div>
        <div class="stat-card">
            <h3>Kamar Tersedia</h3>
            <div class="number" style="color: #28a745;">{{ $kamarTersedia }}</div>
        </div>
        <div class="stat-card">
            <h3>Kamar Terisi</h3>
            <div class="number" style="color: #ff9800;">{{ $kamarTerisi }}</div>
        </div>
        <div class="stat-card">
            <h3>Pendapatan Bulan Ini</h3>
            <div class="number" style="color: #0066cc; font-size: 1.25rem;">Rp {{ number_format($totalPendapatanBulanIni, 0, ',', '.') }}</div>
        </div>
        <div class="stat-card">
            <h3>Pembayaran Tertunggak</h3>
            <div class="number" style="color: #dc3545;">{{ $pembayaranTertunggak }}</div>
        </div>
    </div>

    <!-- Secondary Statistics -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
        <div class="card">
            <h3>Total Penyewa & Kontrak</h3>
            <table>
                <tr>
                    <td>Total Penyewa</td>
                    <td style="text-align: right; font-weight: bold;">{{ $totalPenyewa }}</td>
                </tr>
                <tr>
                    <td>Kontrak Aktif</td>
                    <td style="text-align: right; font-weight: bold;">{{ $kontrakAktif }}</td>
                </tr>
            </table>
        </div>

        <!-- Top Tunggakan -->
        <div class="card">
            <h3>Top 5 Pembayaran Tertunggak</h3>
            @forelse($topTertunggak as $item)
                <div style="padding-bottom: 0.75rem; border-bottom: 1px solid #f0f0f0;">
                    <p style="font-size: 0.875rem; font-weight: 500; color: #333;">{{ $item->kontrakSewa->penyewa->nama_lengkap ?? 'N/A' }}</p>
                    <p style="font-size: 0.75rem; color: #999;">{{ $item->getMonthName() }} {{ $item->tahun }}</p>
                    <p style="font-size: 0.875rem; font-weight: bold; color: #dc3545;">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</p>
                </div>
            @empty
                <p class="empty-msg">Tidak ada tunggakan</p>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <h3>Aksi Cepat</h3>
        <div class="quick-actions">
            <a href="{{ route('kamar.create') }}" class="action-btn">
                <i class="fas fa-plus"></i>
                <span>Tambah Kamar</span>
            </a>
            <a href="{{ route('penyewa.create') }}" class="action-btn">
                <i class="fas fa-user-plus"></i>
                <span>Tambah Penyewa</span>
            </a>
            <a href="{{ route('kontrak-sewa.create') }}" class="action-btn">
                <i class="fas fa-file-contract"></i>
                <span>Buat Kontrak</span>
            </a>
            <a href="{{ route('pembayaran.create') }}" class="action-btn">
                <i class="fas fa-money-bill"></i>
                <span>Catat Pembayaran</span>
            </a>
        </div>
    </div>
</div>
@endsection
