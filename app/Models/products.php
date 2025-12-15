<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $timestamps = true;

    protected $fillable = [
        'sku',
        'product_name',
        'description',

        'price',
        'discount',
        'harga_jual',

        'stock',

        'weight',
        'dimension_length',
        'dimension_width',
        'dimension_height',

        'image_url',
        'image_url2',
        'image_url3',
        'image_url4',
        'image_url5',

        'category_id',
        'shipping_cost_total',

        // Polymorphic created_by
        'created_by_id',
        'created_by_type',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'harga_jual' => 'decimal:2',
        'shipping_cost_total' => 'decimal:2',
    ];

    // Relasi Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi Polymorphic untuk created_by (Admin atau Customer)
    public function created_by()
    {
        return $this->morphTo();
    }
}
