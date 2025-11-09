<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact_us extends Model
{
    use HasFactory;

    // Tabel yang digunakan
    protected $table = 'contact_us';

    // Primary key
    protected $primaryKey = 'contact_id';

    // Kolom yang dapat diisi
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'subject',
        'message',
    ];
}
