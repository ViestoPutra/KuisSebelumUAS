@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Pembayaran</h1>
            <p class="text-gray-600 mt-2">{{ $pembayaran->getMonthName() }} {{ $pembayaran->tahun }}</p>
        </div>
        <div class="space-x-2">
            <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded transition inline-block">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('pembayaran.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition inline-block">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 space-y-6">
        <!-- Payment Information -->
        <div class="pb-6 border-b">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pembayaran</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Penyewa</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $pembayaran->kontrakSewa->penyewa->nama_lengkap }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Kamar</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $pembayaran->kontrakSewa->kamar->nomor_kamar }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Bulan/Tahun</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $pembayaran->getMonthName() }} {{ $pembayaran->tahun }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Jumlah Bayar</p>
                    <p class="text-lg font-semibold text-green-600 mt-1">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Tanggal Bayar</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $pembayaran->tanggal_bayar->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Status</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $pembayaran->status == 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($pembayaran->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Keterangan -->
        @if($pembayaran->keterangan)
        <div class="pb-6 border-b">
            <p class="text-sm text-gray-600 font-medium mb-2">Keterangan</p>
            <p class="text-gray-900">{{ $pembayaran->keterangan }}</p>
        </div>
        @endif

        <!-- Bukti Transfer -->
        @if($pembayaran->bukti_transfer)
        <div class="pb-6 border-b">
            <p class="text-sm text-gray-600 font-medium mb-3">Bukti Transfer</p>
            <img src="{{ asset('storage/' . $pembayaran->bukti_transfer) }}" alt="Bukti Transfer" class="max-w-md rounded-lg border shadow">
        </div>
        @endif

        <!-- Timestamps -->
        <div class="pt-3 space-y-3 text-sm text-gray-600">
            <p>Dicatat: {{ $pembayaran->created_at->format('d M Y H:i') }}</p>
            <p>Terakhir diubah: {{ $pembayaran->updated_at->format('d M Y H:i') }}</p>
        </div>
    </div>
</div>
@endsection
