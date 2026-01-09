@extends('layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Tambah Kamar Baru</h1>
        <p class="text-gray-600 mt-2">Masukkan data kamar baru ke dalam sistem</p>
    </div>

    <form action="{{ route('kamar.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-6">
        @csrf
        
        <!-- Nomor Kamar -->
        <div>
            <label for="nomor_kamar" class="block text-sm font-medium text-gray-700 mb-2">Nomor Kamar <span class="text-red-500">*</span></label>
            <input type="text" id="nomor_kamar" name="nomor_kamar" value="{{ old('nomor_kamar') }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                placeholder="Contoh: A1, B2" required>
            @error('nomor_kamar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tipe Kamar -->
        <div>
            <label for="tipe" class="block text-sm font-medium text-gray-700 mb-2">Tipe Kamar <span class="text-red-500">*</span></label>
            <select id="tipe" name="tipe" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="standard" {{ old('tipe') == 'standard' ? 'selected' : '' }}>Standard</option>
                <option value="deluxe" {{ old('tipe') == 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                <option value="vip" {{ old('tipe') == 'vip' ? 'selected' : '' }}>VIP</option>
            </select>
            @error('tipe')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga Bulanan -->
        <div>
            <label for="harga_bulanan" class="block text-sm font-medium text-gray-700 mb-2">Harga Bulanan (Rp) <span class="text-red-500">*</span></label>
            <input type="number" id="harga_bulanan" name="harga_bulanan" value="{{ old('harga_bulanan') }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                placeholder="1000000" min="0" step="1000" required>
            @error('harga_bulanan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Fasilitas -->
        <div>
            <label for="fasilitas" class="block text-sm font-medium text-gray-700 mb-2">Fasilitas <span class="text-red-500">*</span></label>
            <textarea id="fasilitas" name="fasilitas" rows="4" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                placeholder="Contoh: AC, WiFi, Tempat Tidur, Lemari" required>{{ old('fasilitas') }}</textarea>
            @error('fasilitas')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
            <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                <option value="">-- Pilih Status --</option>
                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="terisi" {{ old('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('kamar.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded transition">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
