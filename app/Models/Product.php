<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'short_description',
        'discounted_price',
        'in_stock',
        'is_active',
        'brand',
        'cover_image',
        'main_category',
        'parent_product',
        'images',
        'value',
        'variant',
        'long_description',
        
    ];
}
