<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Penyewa::with('kontrakSewa.kamar');
        
        // Search by name or phone
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('nama_lengkap', 'like', "%$search%")
                  ->orWhere('nomor_telepon', 'like', "%$search%");
        }
        
        $penyewa = $query->get();
        
        return view('penyewa.index', compact('penyewa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penyewa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|max:100',
            'nomor_telepon' => 'required|max:15',
            'nomor_ktp' => 'required|unique:penyewa|max:20',
            'alamat_asal' => 'required|string',
            'pekerjaan' => 'required|max:50',
        ]);
        
        Penyewa::create($validated);
        
        return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyewa $penyewa)
    {
        $penyewa->load('kontrakSewa.kamar', 'kontrakSewa.pembayaran');
        return view('penyewa.show', compact('penyewa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyewa $penyewa)
    {
        return view('penyewa.edit', compact('penyewa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penyewa $penyewa)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|max:100',
            'nomor_telepon' => 'required|max:15',
            'nomor_ktp' => 'required|unique:penyewa,nomor_ktp,' . $penyewa->id . '|max:20',
            'alamat_asal' => 'required|string',
            'pekerjaan' => 'required|max:50',
        ]);
        
        $penyewa->update($validated);
        
        return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyewa $penyewa)
    {
        // Check if penyewa has active contract
        if ($penyewa->hasActiveContract()) {
            return redirect()->route('penyewa.index')->with('error', 'Penyewa tidak dapat dihapus karena memiliki kontrak aktif');
        }
        
        $penyewa->delete();
        return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil dihapus');
    }
}
