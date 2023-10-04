<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasFactory,softDeletes,HasUuids;
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
        'slug',
        
    ];

}
