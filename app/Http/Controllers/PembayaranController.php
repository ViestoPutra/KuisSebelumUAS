<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\KontrakSewa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pembayaran::with(['kontrakSewa.penyewa', 'kontrakSewa.kamar']);
        
        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        $pembayaran = $query->get();
        
        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kontrak = KontrakSewa::where('status', 'aktif')->with('penyewa', 'kamar')->get();
        return view('pembayaran.create', compact('kontrak'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kontrak_sewa_id' => 'required|exists:kontrak_sewa,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:2099',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'status' => 'required|in:lunas,tertunggak',
            'keterangan' => 'nullable|string',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Handle file upload
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $path = $file->store('bukti_transfer', 'public');
            $validated['bukti_transfer'] = $path;
        }
        
        Pembayaran::create($validated);
        
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dicatat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load('kontrakSewa.penyewa', 'kontrakSewa.kamar');
        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        $kontrak = KontrakSewa::with('penyewa', 'kamar')->get();
        return view('pembayaran.edit', compact('pembayaran', 'kontrak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'kontrak_sewa_id' => 'required|exists:kontrak_sewa,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:2099',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'status' => 'required|in:lunas,tertunggak',
            'keterangan' => 'nullable|string',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Handle file upload
        if ($request->hasFile('bukti_transfer')) {
            // Delete old file if exists
            if ($pembayaran->bukti_transfer) {
                \Storage::disk('public')->delete($pembayaran->bukti_transfer);
            }
            
            $file = $request->file('bukti_transfer');
            $path = $file->store('bukti_transfer', 'public');
            $validated['bukti_transfer'] = $path;
        }
        
        $pembayaran->update($validated);
        
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        // Delete file if exists
        if ($pembayaran->bukti_transfer) {
            \Storage::disk('public')->delete($pembayaran->bukti_transfer);
        }
        
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus');
    }
}
