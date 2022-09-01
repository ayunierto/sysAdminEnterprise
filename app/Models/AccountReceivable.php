<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountReceivable extends Model
{
    use HasFactory;
    protected $fillable = [
        'companies_id',
        'orders_id',
        'payment',
        'debt',
        'description',
        'state',
    ];
}
