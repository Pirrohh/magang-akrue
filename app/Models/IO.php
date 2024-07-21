<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IO extends Model
{
    use HasFactory;

    protected $table = 'i_o_s';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'kode',
        'nomor_inet',
        'billing_inet',
        'nomor_pots',
        'billing_pots',
        'periode_billing',
        'total_billing',
        'revenue_sharing_inet',
        'revenue_sharing_pots',
        'total_billing_sharing',
        'total_nilai_sharing',
        'updated_at',
        'created_at'
    ];

    public function mitras(): BelongsTo
    {
        return $this->belongsTo(Mitra::class,'periode_billing', 'periode_billing');
    }

    public function pelanggans(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'nomor_inet', 'nomor_inet');
    }

    public function billings(): BelongsTo
    {
        return $this->belongsTo(Billing::class);
    }
}
