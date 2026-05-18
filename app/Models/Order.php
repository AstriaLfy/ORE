<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'total_price',
        'status'
    ];

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
    use HasFactory;

    // Menyesuaikan primary key dengan skema kamu
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'user_id',
        'product_id',
        'tanggal',
        'status'
    ];

    // Jika skema database gabungan (Monolithic), tambahkan relasi ini:
    /*
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id_product');
    }
    */
}