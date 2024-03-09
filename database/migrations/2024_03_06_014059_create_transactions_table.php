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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('court_id')->constrained()->cascadeOnDelete();
            $table->string('unique_code');
            $table->timestamp('booking_start');
            $table->timestamp('booking_end');
            $table->unsignedInteger('total_price');
            $table->enum('status', ['pending', 'success', 'cancelled', 'refund'])->default('pending');
            $table->enum('payment_method', ['bank_transfer', 'qris', 'cstore'])->nullable();
            $table->string('payment_service')->nullable();
            $table->string('payment_code')->nullable();     // this column for store response if user select bank or retail method
            $table->string('payment_link')->nullable();     // this column for store response if user select qris method ( show qr code)
            $table->timestamp('expired_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
