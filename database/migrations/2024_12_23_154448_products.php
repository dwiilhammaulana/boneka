<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id'); // Kolom primary key
            $table->string('product_name', 100);
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key ke tabel categories
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps(0); // created_at dan updated_at
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null'); // Foreign key
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
