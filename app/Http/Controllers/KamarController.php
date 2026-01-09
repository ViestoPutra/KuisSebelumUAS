<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kamar::query();
        
        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        // Filter by tipe
        if ($request->has('tipe') && $request->tipe !== '') {
            $query->where('tipe', $request->tipe);
        }
        
        $kamar = $query->get();
        
        return view('kamar.index', compact('kamar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|unique:kamar|max:10',
            'tipe' => 'required|in:standard,deluxe,vip',
            'harga_bulanan' => 'required|numeric|min:0',
            'fasilitas' => 'required|string',
            'status' => 'required|in:tersedia,terisi',
        ]);
        
        Kamar::create($validated);
        
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        $kamar->load('kontrakSewa.penyewa');
        return view('kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        return view('kamar.edit', compact('kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|unique:kamar,nomor_kamar,' . $kamar->id . '|max:10',
            'tipe' => 'required|in:standard,deluxe,vip',
            'harga_bulanan' => 'required|numeric|min:0',
            'fasilitas' => 'required|string',
            'status' => 'required|in:tersedia,terisi',
        ]);
        
        $kamar->update($validated);
        
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        // Check if kamar has ever been rented
        if ($kamar->kontrakSewa()->exists()) {
            return redirect()->route('kamar.index')->with('error', 'Kamar tidak dapat dihapus karena pernah disewa');
        }
        
        $kamar->delete();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus');
    }
}
