<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class ProductItem extends Model
{
    use HasFactory,HasUuids;
    protected $fillable = [
        
        'product_id',
        'color',
        'price',
        'final_price',
        'is_available',
        'quantity',
        'tags',
        'ordering'
    ];
}
