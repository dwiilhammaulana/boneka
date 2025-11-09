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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id'); // Kolom primary key
            $table->unsignedBigInteger('customer_id'); // Foreign key ke tabel customers
            $table->timestamp('order_date')->useCurrent();
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade'); // Foreign key
            $table->timestamps(0); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
