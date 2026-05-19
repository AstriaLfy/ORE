<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'payment_status'
    ];

    /**
     * Relasi: Transaction belongsTo Order
     * Foreign key: transactions.order_id -> orders.id_order
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id_order');
    }
}