<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggans';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'kode',
        'nama_mitra',
        'nama_lop',
        'nomor_inet',
        'nomor_pots',
        'nama_pelanggan',
        'tanggal_aktivasi',
        'updated_at',
        'created_at'
    ];
    
    public function mitras(): BelongsTo
    {
        return $this->belongsTo(Mitra::class, 'nama_mitra', 'nama_mitra');
    }

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }
    public function io(): HasMany
    {
        return $this->hasMany(IO::class);
    
    }
}
