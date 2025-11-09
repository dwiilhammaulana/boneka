<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class customers extends Authenticatable
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'customers';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'username',
        'password',
        'email',
        'full_name',
        'phone_number',
        'address',
    ];

    // Menentukan bahwa customer menggunakan timestamps
    public $timestamps = true;

    // Menambahkan custom primary key jika diperlukan
    protected $primaryKey = 'customer_id';

    // Untuk keamanan, Anda bisa menggunakan mutator untuk password
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Jika kolom 'customer_id' tidak berformat integer, tambahkan ini
    // protected $keyType = 'string';

    // Relasi dengan Order model (One-to-Many)
    public function orders()
    {
        return $this->hasMany(orders::class, 'customer_id', 'customer_id');
    }
}
