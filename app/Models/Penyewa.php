<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    use HasFactory;
    
    protected $table = 'penyewa';
    
    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'nomor_ktp',
        'alamat_asal',
        'pekerjaan',
    ];
    
    public function kontrakSewa()
    {
        return $this->hasMany(KontrakSewa::class);
    }
    
    public function hasActiveContract()
    {
        return $this->kontrakSewa()->where('status', 'aktif')->exists();
    }
}
