<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class ProductItemSize extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'product_item_sizes';
    protected $fillable = [
        
        'product_item_id',
        'itemname',
        'itemquantity',
    ];
   
}
