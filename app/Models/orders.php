<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'orders';

    // Primary key
    protected $primaryKey = 'order_id';

    // Auto increment
    public $incrementing = true;

    // Tipe PK
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'customer_id',
        'order_date',
        'status',
        'payment_method',
        'total_price',
        'shipping_cost',
        'grand_total',
        'receiver_name',
        'receiver_phone',
        'shipping_address',
        'customer_note',
    ];

    // Casting tipe data
    protected $casts = [
        'order_date'    => 'datetime',
        'total_price'   => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'grand_total'   => 'decimal:2',
    ];

    // Timestamps aktif (created_at & updated_at ada di tabel)
    public $timestamps = true;

    /* ================= RELATION ================= */

    // Order -> Customer (Many to One)
    public function customer()
    {
        return $this->belongsTo(customers::class, 'customer_id', 'customer_id');
    }

    // Order -> Order Detail (One to Many)
    public function orderDetails()
    {
        return $this->hasMany(orders_details::class, 'order_id', 'order_id');
    }

    // Order -> Pembayaran (One to Many)
    public function pembayaran()
    {
        return $this->hasMany(\App\Models\Pembayaran::class, 'order_id', 'order_id');
    }
}
