<?php

use Faker\Provider\Payment;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('table_id')->constrained('tables')->onDelete('cascade');
            $table->dateTime('time');
            $table->integer('guest_count');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('special_requests')->nullable();
            $table->bigInteger('total_price')->default(0);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->enum('payment_method', ['vnpay', 'cash'])->default('vnpay');
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
