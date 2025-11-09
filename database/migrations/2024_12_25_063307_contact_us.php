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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id('contact_id'); // Primary key
            $table->string('first_name', 100); // First name of the sender
            $table->string('last_name', 100); // Last name of the sender
            $table->string('email', 100); // Email of the sender
            $table->string('subject', 150)->nullable(); // Subject of the message
            $table->text('message'); // Content of the message
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
};
