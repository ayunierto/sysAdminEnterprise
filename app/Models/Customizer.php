<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customizer extends Model
{
    use HasFactory;
    protected $fillable = [
        'companies_id',
        'color_menu',
        'color_header',
        'color_footer',
        'colot_text',
        'logo',
    ];
}
