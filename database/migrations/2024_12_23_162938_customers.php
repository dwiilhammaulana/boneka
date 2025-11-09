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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id'); // Kolom primary key
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->string('email', 100)->unique();
            $table->string('full_name', 100)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->text('address')->nullable();
            $table->timestamps(0); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
