@extends('layouts.app')

@section('title', 'Daftar Penyewa')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Daftar Penyewa</h1>
        <a href="{{ route('penyewa.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
            <i class="fas fa-user-plus"></i> Tambah Penyewa
        </a>
    </div>

    <!-- Search Section -->
    <div class="bg-white rounded-lg shadow-md p-4">
        <form method="GET" action="{{ route('penyewa.index') }}" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" placeholder="Cari nama atau telepon..." value="{{ request('search') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                <i class="fas fa-search"></i> Cari
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Penyewa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. KTP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pekerjaan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kamar Sewa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($penyewa as $p)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $p->nama_lengkap }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $p->nomor_telepon }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $p->nomor_ktp }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $p->pekerjaan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $activeContract = $p->kontrakSewa()->where('status', 'aktif')->first();
                            @endphp
                            @if($activeContract)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $activeContract->kamar->nomor_kamar }}
                                </span>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('penyewa.show', $p->id) }}" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('penyewa.edit', $p->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('penyewa.destroy', $p->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i>
                            <p>Belum ada data penyewa</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
