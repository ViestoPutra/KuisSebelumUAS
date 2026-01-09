@extends('layouts.app')

@section('title', 'Tambah Penyewa')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Tambah Penyewa Baru</h1>
        <p class="text-gray-600 mt-2">Registrasi data penyewa baru ke dalam sistem</p>
    </div>

    <form action="{{ route('penyewa.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-6">
        @csrf
        
        <!-- Nama Lengkap -->
        <div>
            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                placeholder="Nama lengkap penyewa" required>
            @error('nama_lengkap')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nomor Telepon -->
        <div>
            <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                placeholder="08xxxxxxxxxx" required>
            @error('nomor_telepon')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nomor KTP -->
        <div>
            <label for="nomor_ktp" class="block text-sm font-medium text-gray-700 mb-2">Nomor KTP <span class="text-red-500">*</span></label>
            <input type="text" id="nomor_ktp" name="nomor_ktp" value="{{ old('nomor_ktp') }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                placeholder="3275xxxxxxxxxx" required>
            @error('nomor_ktp')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Alamat Asal -->
        <div>
            <label for="alamat_asal" class="block text-sm font-medium text-gray-700 mb-2">Alamat Asal <span class="text-red-500">*</span></label>
            <textarea id="alamat_asal" name="alamat_asal" rows="4" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                placeholder="Alamat KTP/Asal" required>{{ old('alamat_asal') }}</textarea>
            @error('alamat_asal')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Pekerjaan -->
        <div>
            <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan <span class="text-red-500">*</span></label>
            <input type="text" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                placeholder="Mahasiswa, Karyawan, dll" required>
            @error('pekerjaan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('penyewa.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded transition">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
