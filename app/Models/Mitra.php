<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mitra extends Model
{
    use HasFactory;
    protected $table = 'mitras';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'kode',
        'nama_mitra',
        'nama_lop',
        'periode_billing',
        'bulan_awal_sharing',
        'bulan_akhir_sharing',
        'sharing(%)',
        'updated_at',
        'created_at'
    ];
   
    public function pelanggans(): HasMany
    {
        return $this->hasMany(Pelanggan::class);
    
    }

    public function io(): HasMany
    {
        return $this->hasMany(IO::class);
    
    }

    public function billings(): HasMany
    {
        return $this->hasMany(Billing::class,'periode_billing', 'periode_billing');
    
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($mitra) {
    //         // Mengambil huruf pertama dari kata kedua dan ketiga
    //         $initials = substr($mitra->nama_mitra, 0, 2);

    //         // Mencari jumlah entri yang sudah ada dengan huruf awal yang sama
    //         $count = static::where('id', 'like', $initials . '%')->count() + 1;
 
    //         // Membuat ID unik
    //         $mitra->id = $initials . $count;
    //     });
    // }
}
