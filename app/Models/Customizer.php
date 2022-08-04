<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customizer extends Model
{
    use HasFactory;
    protected $fillable = [
        'companies_id',
        'primary_color',
        'secondary_color',
        'tertiary_color',
        'logo',
    ];
}
