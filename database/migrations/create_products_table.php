<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->string('slug');
            $table->string('short-description');
            $table->string('keypoints');
            $table->float('discounted-price');
            $table->integer('in-stock');
            $table->boolean('is_active');
            $table->softDeletes();
            $table->string('brand');
            $table->string('cover-image');
            $table->integer('main-category');
            $table->integer('parent_product');
            $table->string('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
