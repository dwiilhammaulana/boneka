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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('order_detail_id'); // Kolom primary key
            $table->unsignedBigInteger('order_id'); // Foreign key ke tabel orders
            $table->unsignedBigInteger('product_id'); // Foreign key ke tabel products
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade'); // Foreign key
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade'); // Foreign key
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
