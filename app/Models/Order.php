<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'companies_id',
        'customers_id',
        'payment_methods_id',
        'proof_payments_id',
        'coins_id',
        'documents_id',
        'voucher_number',
        'exchange_rate',
        'total',
        'date',
        'state',
        'description',
    ];
}
