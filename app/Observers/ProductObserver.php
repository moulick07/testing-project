<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */

     public function creating(Product $product)
     {
    }
    public function created(Product $product): void
    {
        // Generate new slug with a id suffix
              $product->slug = \Str::slug($product->name).'/'.$product->id;
    }
        
      
    
        
    

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        $product->slug = \Str::slug($product->name).'/'.$product->id;        
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
