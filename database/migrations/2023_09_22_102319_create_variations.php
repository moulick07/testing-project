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
        Schema::create('variation_tables', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('title');
            $table->string('type');
            $table->string('value')->nullable();
            $table->string('prefix')->nullable();
            $table->string('postfix')->nullable();
            $table->string('countable')->nullable();
            $table->softDeletes();
            $table->string('category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variation_tables');
    }
};
