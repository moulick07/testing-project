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


        /**
         * Get all of the comments for the ProductItem
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function productMedia()
        {
            return $this->hasMany(ProductMedia::class, 'product_item_id');
        }
        public function productSize()
        {
            return $this->hasMany(ProductItemSize::class, 'product_item_id');
        }

    }