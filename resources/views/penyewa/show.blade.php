@extends('layouts.app')

@section('title', 'Detail Penyewa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Penyewa</h1>
            <p class="text-gray-600 mt-2">{{ $penyewa->nama_lengkap }}</p>
        </div>
        <div class="space-x-2">
            <a href="{{ route('penyewa.edit', $penyewa->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded transition inline-block">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('penyewa.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition inline-block">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Personal Information -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pribadi</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-600 font-medium">Nama Lengkap</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $penyewa->nama_lengkap }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-medium">Nomor Telepon</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $penyewa->nomor_telepon }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-medium">Nomor KTP</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $penyewa->nomor_ktp }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-medium">Pekerjaan</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $penyewa->pekerjaan }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm text-gray-600 font-medium">Alamat Asal</p>
                <p class="text-gray-900 whitespace-pre-wrap mt-1">{{ $penyewa->alamat_asal }}</p>
            </div>
        </div>
    </div>

    <!-- Riwayat Kontrak -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Riwayat Kontrak</h3>
        @if($penyewa->kontrakSewa->count() > 0)
            <div class="space-y-4">
                @foreach($penyewa->kontrakSewa as $kontrak)
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <p class="font-semibold text-gray-900">Kamar {{ $kontrak->kamar->nomor_kamar }}</p>
                                <p class="text-sm text-gray-600">{{ $kontrak->tanggal_mulai->format('d M Y') }} - {{ $kontrak->tanggal_selesai->format('d M Y') }}</p>
                            </div>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $kontrak->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($kontrak->status) }}
                            </span>
                        </div>
                        <p class="text-gray-900 mb-3">Harga: <strong>Rp {{ number_format($kontrak->harga_bulanan, 0, ',', '.') }}</strong>/bulan</p>
                        
                        <!-- Pembayaran -->
                        @if($kontrak->pembayaran->count() > 0)
                            <div class="mt-3">
                                <p class="text-sm font-medium text-gray-700 mb-2">Pembayaran:</p>
                                <div class="space-y-2">
                                    @foreach($kontrak->pembayaran as $pembayaran)
                                        <div class="flex justify-between items-center text-sm bg-gray-50 p-2 rounded">
                                            <span>{{ $pembayaran->getMonthName() }} {{ $pembayaran->tahun }}</span>
                                            <div class="flex items-center gap-3">
                                                <span>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</span>
                                                <span class="px-2 py-1 rounded text-xs font-semibold 
                                                    {{ $pembayaran->status == 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ ucfirst($pembayaran->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">Belum ada kontrak</p>
        @endif
    </div>
</div>
@endsection
