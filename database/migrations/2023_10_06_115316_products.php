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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('image_path');
            $table->string('description', 512);
            $table->integer('price');
            $table->boolean('is_active');
            $table->integer('priority')->nullable();

            $table->bigInteger('category_id', false, true)->nullable();
            $table->index('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
