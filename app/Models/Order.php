<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'products_id',
        'orders_id',
        'affectation_igvs_id',
        'quantity',
        'precio',
        'descuento',
    ];
}