<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'medicines',
    'name_customer',
    'total_price',

    ];

    // pengasaan tipe data dari migration 9hasil property ini ketika diambil insert atau diinsert/update dibuat dalan=m bentuk tipe data apa)
    protected $casts = [
        'medicines' => 'array',
    ];
}
