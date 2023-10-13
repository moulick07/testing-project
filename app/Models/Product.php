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
        'category_id',
        'short_description',
        'brand',
        'is_active',
        'product_type',
        'slug',
      
    ];

    public static function boot()
    {
        parent::boot();
        self::created(function($product){
            $product->slug = \Str::slug($product->name).'/'.$product->id;
        });
        self::updated(function($product){
            $product->slug = \Str::slug($product->name).'/'.$product->id; 
        });

       
    }
    public function productItem()
    {
        return $this->hasMany(ProductItem::class, 'product_id');
    }

   
}
