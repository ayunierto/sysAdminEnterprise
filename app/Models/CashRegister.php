<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    use HasFactory;
    protected $fillable = [
        'companies_id',
        'description',
        'amount_pen',
        'amount_usd',
        'state',
    ];
}
