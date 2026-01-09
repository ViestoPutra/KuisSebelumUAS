@extends('layouts.app')

@section('title', 'Buat Kontrak Sewa')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Buat Kontrak Sewa Baru</h1>
        <p class="text-gray-600 mt-2">Pilih penyewa dan kamar untuk membuat kontrak sewa baru</p>
    </div>

    <form action="{{ route('kontrak-sewa.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-6">
        @csrf
        
        <!-- Penyewa -->
        <div>
            <label for="penyewa_id" class="block text-sm font-medium text-gray-700 mb-2">Penyewa <span class="text-red-500">*</span></label>
            <select id="penyewa_id" name="penyewa_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                <option value="">-- Pilih Penyewa --</option>
                @foreach($penyewa as $p)
                    <option value="{{ $p->id }}" {{ old('penyewa_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_lengkap }} ({{ $p->nomor_telepon }})
                    </option>
                @endforeach
            </select>
            @error('penyewa_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kamar -->
        <div>
            <label for="kamar_id" class="block text-sm font-medium text-gray-700 mb-2">Kamar (Tersedia) <span class="text-red-500">*</span></label>
            <select id="kamar_id" name="kamar_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                <option value="">-- Pilih Kamar --</option>
                @foreach($kamar as $k)
                    <option value="{{ $k->id }}" {{ old('kamar_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nomor_kamar }} - {{ ucfirst($k->tipe) }} (Rp {{ number_format($k->harga_bulanan, 0, ',', '.') }})
                    </option>
                @endforeach
            </select>
            @error('kamar_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggal Mulai -->
        <div>
            <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai <span class="text-red-500">*</span></label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
            @error('tanggal_mulai')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggal Selesai -->
        <div>
            <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai <span class="text-red-500">*</span></label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
            @error('tanggal_selesai')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga Bulanan -->
        <div>
            <label for="harga_bulanan" class="block text-sm font-medium text-gray-700 mb-2">Harga Bulanan (Rp) <span class="text-red-500">*</span></label>
            <input type="number" id="harga_bulanan" name="harga_bulanan" value="{{ old('harga_bulanan') }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                min="0" step="1000" required>
            @error('harga_bulanan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
            <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('kontrak-sewa.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded transition">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
                <i class="fas fa-save"></i> Buat Kontrak
            </button>
        </div>
    </form>
</div>
@endsection
