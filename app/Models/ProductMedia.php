<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class ProductMedia extends Model
{

    use HasFactory,HasUuids;
    protected $table = 'product_medias';
    protected $fillable = [
        
        'product_item_id',
        'path',
        'name',
        'type',
        'image',
        'ordering'
     ];
}
