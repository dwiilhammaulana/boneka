<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'category_id',
        'price',
        'stock',
        'description',
        'image_url',
        'image_url2',
        'image_url3',
        'image_url4',
        'image_url5',
        'warna',
        'tahun',
        'kilometer',
        'status',
        'created_by_id',    
        'created_by_type',   
    ];

    public $timestamps = true;

    protected $primaryKey = 'product_id';

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relasi dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // ✅ Relasi Polymorphic untuk created_by (Admin atau Customer)
    public function created_by()
    {
        return $this->morphTo();
    }
}
