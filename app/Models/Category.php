<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Category extends Model
{
    use HasFactory,SoftDeletes,HasUuids;
    protected $fillable = [
        'title',
        'description',
        'parent_category',
        'is_parent',
        'slug',
        
    ];
    public static function boot()
    {
        parent::boot();
        self::created(function($Category){
            $Category->slug = \Str::slug($Category->name).'/'.$Category->id;
        });
        self::updated(function($Category){
            $Category->slug = \Str::slug($Category->name).'/'.$Category->id; 
        });

       
    }
    
}
