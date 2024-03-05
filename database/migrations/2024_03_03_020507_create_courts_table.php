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
        Schema::create('courts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug');
            $table->enum('type', ['futsal', 'badminton']);
            $table->text('description');
            $table->string('banner');
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('weekday_price');
            $table->unsignedBigInteger('weekend_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};
