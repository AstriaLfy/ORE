<?php

namespace App\Models;

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
}