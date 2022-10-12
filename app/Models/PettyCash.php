<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class PettyCash extends Model
{
    use HasFactory;
    protected $fillable = [
        'companies_id',
        'coins_id',
        'description',
        'amount',
        'state',
    ];
}
