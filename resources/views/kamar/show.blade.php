@extends('layouts.app')

@section('title', 'Detail Kamar')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Kamar {{ $kamar->nomor_kamar }}</h1>
            <p class="text-gray-600 mt-2">Informasi lengkap kamar</p>
        </div>
        <div class="space-x-2">
            <a href="{{ route('kamar.edit', $kamar->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded transition inline-block">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('kamar.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition inline-block">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 space-y-6">
        <!-- Basic Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b">
            <div>
                <p class="text-sm text-gray-600 font-medium">Nomor Kamar</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $kamar->nomor_kamar }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-medium">Tipe Kamar</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $kamar->tipe == 'standard' ? 'bg-blue-100 text-blue-800' : ($kamar->tipe == 'deluxe' ? 'bg-purple-100 text-purple-800' : 'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst($kamar->tipe) }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-medium">Harga Bulanan</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-medium">Status</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $kamar->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($kamar->status) }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Fasilitas -->
        <div class="pt-6">
            <p class="text-sm text-gray-600 font-medium mb-3">Fasilitas</p>
            <p class="text-gray-900 whitespace-pre-wrap">{{ $kamar->fasilitas }}</p>
        </div>

        <!-- Timestamps -->
        <div class="pt-6 border-t space-y-3 text-sm text-gray-600">
            <p>Dibuat: {{ $kamar->created_at->format('d M Y H:i') }}</p>
            <p>Terakhir diubah: {{ $kamar->updated_at->format('d M Y H:i') }}</p>
        </div>

        <!-- Riwayat Kontrak -->
        @if($kamar->kontrakSewa->count() > 0)
        <div class="pt-6 border-t">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Riwayat Kontrak</h3>
            <div class="space-y-3">
                @foreach($kamar->kontrakSewa as $kontrak)
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium text-gray-900">{{ $kontrak->penyewa->nama_lengkap }}</p>
                                <p class="text-sm text-gray-600">{{ $kontrak->tanggal_mulai->format('d M Y') }} - {{ $kontrak->tanggal_selesai->format('d M Y') }}</p>
                            </div>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $kontrak->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($kontrak->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
