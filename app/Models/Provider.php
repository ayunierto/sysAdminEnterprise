<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'companies_id',
        'name',
        'document',
        'address',
        'phone',
        'city',
        'state',
        'description',
    ];
}
