<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders_details extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'order_details';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];
    

    // Menentukan bahwa order detail menggunakan timestamps
    public $timestamps = false;

    // Menambahkan custom primary key jika diperlukan
    protected $primaryKey = 'order_detail_id';

    // Menentukan tipe data untuk price
    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relasi dengan Order model (Many-to-One)
    public function order()
    {
        return $this->belongsTo(orders::class, 'order_id', 'order_id');
    }

    // Relasi dengan Product model (Many-to-One)
    public function product()
    {
        return $this->belongsTo(products::class, 'product_id', 'product_id');
    }
}
