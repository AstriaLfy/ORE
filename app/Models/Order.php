<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Menyesuaikan primary key dengan skema (id_order)
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'user_id',
        'product_id',
        'tanggal',
        'status'
    ];

    /**
     * Relasi: Order hasOne Transaction
     */
    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'order_id', 'id_order');
    }

    /**
     * Relasi: Order belongsTo User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Order belongsTo Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}