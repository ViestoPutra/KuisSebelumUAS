@extends('layouts.app')

@section('title', 'Catat Pembayaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Catat Pembayaran Baru</h1>
        <p class="text-gray-600 mt-2">Masukkan data pembayaran penyewa</p>
    </div>

    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6 space-y-6">
        @csrf
        
        <!-- Kontrak Sewa -->
        <div>
            <label for="kontrak_sewa_id" class="block text-sm font-medium text-gray-700 mb-2">Kontrak Sewa <span class="text-red-500">*</span></label>
            <select id="kontrak_sewa_id" name="kontrak_sewa_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                <option value="">-- Pilih Kontrak Sewa --</option>
                @foreach($kontrak as $k)
                    <option value="{{ $k->id }}" {{ old('kontrak_sewa_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->penyewa->nama_lengkap }} - Kamar {{ $k->kamar->nomor_kamar }}
                    </option>
                @endforeach
            </select>
            @error('kontrak_sewa_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bulan -->
        <div>
            <label for="bulan" class="block text-sm font-medium text-gray-700 mb-2">Bulan <span class="text-red-500">*</span></label>
            <select id="bulan" name="bulan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                <option value="">-- Pilih Bulan --</option>
                <option value="1" {{ old('bulan') == 1 ? 'selected' : '' }}>Januari</option>
                <option value="2" {{ old('bulan') == 2 ? 'selected' : '' }}>Februari</option>
                <option value="3" {{ old('bulan') == 3 ? 'selected' : '' }}>Maret</option>
                <option value="4" {{ old('bulan') == 4 ? 'selected' : '' }}>April</option>
                <option value="5" {{ old('bulan') == 5 ? 'selected' : '' }}>Mei</option>
                <option value="6" {{ old('bulan') == 6 ? 'selected' : '' }}>Juni</option>
                <option value="7" {{ old('bulan') == 7 ? 'selected' : '' }}>Juli</option>
                <option value="8" {{ old('bulan') == 8 ? 'selected' : '' }}>Agustus</option>
                <option value="9" {{ old('bulan') == 9 ? 'selected' : '' }}>September</option>
                <option value="10" {{ old('bulan') == 10 ? 'selected' : '' }}>Oktober</option>
                <option value="11" {{ old('bulan') == 11 ? 'selected' : '' }}>November</option>
                <option value="12" {{ old('bulan') == 12 ? 'selected' : '' }}>Desember</option>
            </select>
            @error('bulan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tahun -->
        <div>
            <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun <span class="text-red-500">*</span></label>
            <input type="number" id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                min="2000" max="2099" required>
            @error('tahun')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Jumlah Bayar -->
        <div>
            <label for="jumlah_bayar" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Bayar (Rp) <span class="text-red-500">*</span></label>
            <input type="number" id="jumlah_bayar" name="jumlah_bayar" value="{{ old('jumlah_bayar') }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                min="0" step="1000" required>
            @error('jumlah_bayar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggal Bayar -->
        <div>
            <label for="tanggal_bayar" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Bayar <span class="text-red-500">*</span></label>
            <input type="date" id="tanggal_bayar" name="tanggal_bayar" value="{{ old('tanggal_bayar', date('Y-m-d')) }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
            @error('tanggal_bayar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
            <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                <option value="lunas" {{ old('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="tertunggak" {{ old('status') == 'tertunggak' ? 'selected' : '' }}>Tertunggak</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Keterangan -->
        <div>
            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
            <textarea id="keterangan" name="keterangan" rows="3" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bukti Transfer -->
        <div>
            <label for="bukti_transfer" class="block text-sm font-medium text-gray-700 mb-2">Bukti Transfer (Foto)</label>
            <input type="file" id="bukti_transfer" name="bukti_transfer" accept="image/*"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Max: 2MB</p>
            @error('bukti_transfer')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('pembayaran.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded transition">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
