<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'type',
        'prefix',
        'postfix',
        'countable',
        'value',
        'category_id',
    ];
}
