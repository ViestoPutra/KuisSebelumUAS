<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    
    protected $table = 'pembayaran';
    
    protected $fillable = [
        'kontrak_sewa_id',
        'bulan',
        'tahun',
        'jumlah_bayar',
        'tanggal_bayar',
        'status',
        'keterangan',
        'bukti_transfer',
    ];
    
    protected $casts = [
        'tanggal_bayar' => 'date',
    ];
    
    public function kontrakSewa()
    {
        return $this->belongsTo(KontrakSewa::class);
    }
    
    public function isLunas()
    {
        return $this->status === 'lunas';
    }
    
    public function getMonthName()
    {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        return $months[$this->bulan] ?? 'Unknown';
    }
}
