@extends('layouts.app')

@section('title', 'Detail Kontrak Sewa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Kontrak Sewa</h1>
            <p class="text-gray-600 mt-2">Informasi lengkap kontrak sewa</p>
        </div>
        <div class="space-x-2">
            <a href="{{ route('kontrak-sewa.edit', $kontrak_sewa->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded transition inline-block">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('kontrak-sewa.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition inline-block">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Contract Information -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kontrak</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b">
            <div>
                <p class="text-sm text-gray-600 font-medium">Penyewa</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $kontrak_sewa->penyewa->nama_lengkap }}</p>
                <p class="text-sm text-gray-600 mt-1">{{ $kontrak_sewa->penyewa->nomor_telepon }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-medium">Kamar</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $kontrak_sewa->kamar->nomor_kamar }} ({{ ucfirst($kontrak_sewa->kamar->tipe) }})</p>
                <p class="text-sm text-gray-600 mt-1">Rp {{ number_format($kontrak_sewa->kamar->harga_bulanan, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-medium">Tanggal Mulai</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $kontrak_sewa->tanggal_mulai->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-medium">Tanggal Selesai</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $kontrak_sewa->tanggal_selesai->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-medium">Harga Bulanan</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">Rp {{ number_format($kontrak_sewa->harga_bulanan, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-medium">Status</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $kontrak_sewa->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($kontrak_sewa->status) }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- Payment History -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Riwayat Pembayaran</h3>
            <a href="{{ route('pembayaran.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                <i class="fas fa-plus"></i> Catat Pembayaran
            </a>
        </div>
        
        @if($kontrak_sewa->pembayaran->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bulan/Tahun</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Bayar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Bayar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($kontrak_sewa->pembayaran as $pembayaran)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $pembayaran->getMonthName() }} {{ $pembayaran->tahun }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $pembayaran->tanggal_bayar->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $pembayaran->status == 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($pembayaran->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('pembayaran.show', $pembayaran->id) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pembayaran.destroy', $pembayaran->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-4">Belum ada pembayaran</p>
        @endif
    </div>
</div>
@endsection
