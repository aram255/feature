<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';

    protected $fillable = [
        'payment', 'game', 'currency_code', 'amount', 'email', 'rsn', 'last_name', 'first_name', 'price', 'price_usd'
    ];
}
