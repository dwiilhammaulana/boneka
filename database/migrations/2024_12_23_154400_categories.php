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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id'); // Kolom primary key
            $table->string('category_name', 50);
            $table->text('description')->nullable();
            $table->timestamps(0); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
