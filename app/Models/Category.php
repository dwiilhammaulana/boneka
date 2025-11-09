<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Menentukan kolom primary key yang digunakan
    protected $primaryKey = 'category_id';  // Kolom primary key adalah 'category_id'

    protected $fillable = [
        'category_name',
        'description',
    ];
        public $timestamps = true;
        
        
}

