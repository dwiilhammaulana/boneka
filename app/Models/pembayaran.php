<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; // Nama tabel
    protected $primaryKey = 'id_pembayaran'; // Primary key

    public $timestamps = false; // Karena tidak ada kolom created_at dan updated_at

    protected $fillable = [
        'order_id',
        'tanggal_pembayaran',
        'jumlah_bayar',
        'metode',
        'bukti_bayar',
        'snap_token',
    ];

    // Relasi ke model Order (asumsi nama model Order)
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
    
}
