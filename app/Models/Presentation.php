<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    use HasFactory;
    protected $fillable = [
        'companies_id',
        'products_id',
        'name',
        'equivalence',
    ];
}
