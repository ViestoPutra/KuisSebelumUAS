<?php

namespace App\Http\Controllers;

use App\Models\KontrakSewa;
use App\Models\Kamar;
use App\Models\Penyewa;
use Illuminate\Http\Request;

class KontrakSewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kontrak = KontrakSewa::with(['penyewa', 'kamar', 'pembayaran'])->get();
        return view('kontrak-sewa.index', compact('kontrak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penyewa = Penyewa::all();
        $kamar = Kamar::where('status', 'tersedia')->get();
        
        return view('kontrak-sewa.create', compact('penyewa', 'kamar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'penyewa_id' => 'required|exists:penyewa,id',
            'kamar_id' => 'required|exists:kamar,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'harga_bulanan' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,selesai',
        ]);
        
        // Create contract
        $kontrak = KontrakSewa::create($validated);
        
        // Update kamar status to terisi
        $kamar = Kamar::find($validated['kamar_id']);
        $kamar->update(['status' => 'terisi']);
        
        return redirect()->route('kontrak-sewa.index')->with('success', 'Kontrak sewa berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(KontrakSewa $kontrak_sewa)
    {
        $kontrak_sewa->load('penyewa', 'kamar', 'pembayaran');
        return view('kontrak-sewa.show', compact('kontrak_sewa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KontrakSewa $kontrak_sewa)
    {
        $penyewa = Penyewa::all();
        $kamar = Kamar::all();
        
        return view('kontrak-sewa.edit', compact('kontrak_sewa', 'penyewa', 'kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KontrakSewa $kontrak_sewa)
    {
        $validated = $request->validate([
            'penyewa_id' => 'required|exists:penyewa,id',
            'kamar_id' => 'required|exists:kamar,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'harga_bulanan' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,selesai',
        ]);
        
        // If kamar changed, update status of old kamar and new kamar
        if ($kontrak_sewa->kamar_id != $validated['kamar_id']) {
            // Check if old kamar has other active contracts
            $oldKamarHasOtherActive = KontrakSewa::where('kamar_id', $kontrak_sewa->kamar_id)
                ->where('id', '!=', $kontrak_sewa->id)
                ->where('status', 'aktif')
                ->exists();
            
            if (!$oldKamarHasOtherActive) {
                Kamar::find($kontrak_sewa->kamar_id)->update(['status' => 'tersedia']);
            }
            
            // Update new kamar to terisi
            Kamar::find($validated['kamar_id'])->update(['status' => 'terisi']);
        }
        
        $kontrak_sewa->update($validated);
        
        return redirect()->route('kontrak-sewa.index')->with('success', 'Kontrak sewa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KontrakSewa $kontrak_sewa)
    {
        $kamar = $kontrak_sewa->kamar;
        $kontrak_sewa->delete();
        
        // Check if this kamar has other active contracts
        $hasOtherActive = KontrakSewa::where('kamar_id', $kamar->id)
            ->where('status', 'aktif')
            ->exists();
        
        if (!$hasOtherActive) {
            $kamar->update(['status' => 'tersedia']);
        }
        
        return redirect()->route('kontrak-sewa.index')->with('success', 'Kontrak sewa berhasil dihapus');
    }
}
