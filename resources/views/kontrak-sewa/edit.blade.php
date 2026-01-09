@extends('layouts.app')

@section('title', 'Edit Kontrak Sewa')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Kontrak Sewa</h1>
        <p class="text-gray-600 mt-2">Ubah data kontrak sewa</p>
    </div>

    <form action="{{ route('kontrak-sewa.update', $kontrak_sewa->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Penyewa -->
        <div>
            <label for="penyewa_id" class="block text-sm font-medium text-gray-700 mb-2">Penyewa <span class="text-red-500">*</span></label>
            <select id="penyewa_id" name="penyewa_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @foreach($penyewa as $p)
                    <option value="{{ $p->id }}" {{ old('penyewa_id', $kontrak_sewa->penyewa_id) == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_lengkap }}
                    </option>
                @endforeach
            </select>
            @error('penyewa_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kamar -->
        <div>
            <label for="kamar_id" class="block text-sm font-medium text-gray-700 mb-2">Kamar <span class="text-red-500">*</span></label>
            <select id="kamar_id" name="kamar_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @foreach($kamar as $k)
                    <option value="{{ $k->id }}" {{ old('kamar_id', $kontrak_sewa->kamar_id) == $k->id ? 'selected' : '' }}>
                        {{ $k->nomor_kamar }} - {{ ucfirst($k->tipe) }}
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
            <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $kontrak_sewa->tanggal_mulai->format('Y-m-d')) }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
            @error('tanggal_mulai')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggal Selesai -->
        <div>
            <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai <span class="text-red-500">*</span></label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $kontrak_sewa->tanggal_selesai->format('Y-m-d')) }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
            @error('tanggal_selesai')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga Bulanan -->
        <div>
            <label for="harga_bulanan" class="block text-sm font-medium text-gray-700 mb-2">Harga Bulanan (Rp) <span class="text-red-500">*</span></label>
            <input type="number" id="harga_bulanan" name="harga_bulanan" value="{{ old('harga_bulanan', $kontrak_sewa->harga_bulanan) }}" 
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
                <option value="aktif" {{ old('status', $kontrak_sewa->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="selesai" {{ old('status', $kontrak_sewa->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
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
                <i class="fas fa-save"></i> Perbarui
            </button>
        </div>
    </form>
</div>
@endsection
