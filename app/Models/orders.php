<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'orders';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'customer_id',
        'order_date',
        'total_price',
        'bukti_pesanan',
        'status',
        'sisa_tagihan',
        'ktp',
        'stnk',
        'bpkb',
        'logistik',
    ];

    public function details()
    {
        return $this->hasMany(orders_details::class, 'order_id', 'order_id');
    }

    // Menentukan bahwa order menggunakan timestamps
    public $timestamps = true;

    // Menambahkan custom primary key jika diperlukan
    protected $primaryKey = 'order_id';

    // Menentukan tipe data untuk total_price
    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    // Relasi dengan Customer model (One-to-Many)
    public function customer()
    {
        return $this->belongsTo(customers::class, 'customer_id', 'customer_id');
    }

    // Relasi dengan OrderDetail model (One-to-Many)
    public function orderDetails()
    {
        return $this->hasMany(orders_details::class, 'order_id', 'order_id');
    }
    public function pembayaran()
{
    return $this->hasMany(\App\Models\Pembayaran::class, 'order_id');
}

}
