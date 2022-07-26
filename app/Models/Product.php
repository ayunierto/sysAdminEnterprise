<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'companies_id',
        'categories_id',
        'marks_id',
        'measures_id',
        'providers_id',
        'presentations_id',
        'batches_id',
        'name',
        'code',
        'bar_code',
        'stock',
        'purchase_price',
        'sale_price',
        'description',
        'state',
        'expiration_date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
