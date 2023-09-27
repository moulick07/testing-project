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
        'short-description',
        'discounted-price',
        'in-stock',
        'is_active',
        'brand',
        'cover-image',
        'main-category',
        'parent_product',
        'images',
        'value',
        'variant',
        'long-description',
        
    ];
}
