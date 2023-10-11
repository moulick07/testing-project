<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Temp;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void

    {

        //creating a temporary table for uploading older data 
        Schema::create('temps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('short_description');
            
            $table->boolean('is_active');
            $table->string('brand');
        
          
            $table->timestamps();
            $table->softDeletes();
        });
        foreach(Product::all() as  $item)
        {
            DB::table('temps')->insert(array('id'=>$item->id,
            'name' => $item ->name  ,
            'short_description' => $item ->short_description,
            'slug' => $item->slug,
            'brand' =>$item->brand,
            'is_active'=>$item->is_active,
        ));//you can save other columns with adding array values
        }

        //dropping the older table product
        Schema::dropIfExists('products');

        //creating new table
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('short_description');
            $table->string('product_type')->nullable();
            $table->boolean('is_active');
            $table->string('brand');
            $table->timestamps();
            $table->softDeletes();
        });

        //getting value from the temp table and then adding it to the new product table
        $product = DB::table('temps')->get();
        foreach($product as  $item)
        {
            DB::table('products')->insert(array(
             'id' => $item->id,  
            'name' => $item ->name  ,
            'short_description' => $item ->short_description,
            'slug' => $item->slug,
            'brand' =>$item->brand,
            'is_active'=>$item->is_active,));
        }
        //deleting the temp table
        Schema::dropIfExists('temps');
       
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
            Schema::dropIfExists('products');

        });
    }
};
