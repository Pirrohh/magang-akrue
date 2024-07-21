<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Billing extends Model
{
    use HasFactory;

    protected $table = 'billings';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'kode',
        'nomor_inet',
        'billing_inet',
        'nomor_pots',
        'periode_billing',
        'total_billing',
        'tanggal_bayar',
        'updated_at',
        'created_at'
    ];

    public function pelanggans(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }
    
    public function mitras(): BelongsTo
    {
        return $this->belongsTo(Mitra::class,'periode_billing', 'periode_billing');
    }
}
