<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assumes users table exists
            $table->string('user_name');
            $table->string('full_name');
            $table->string('phone_number');
            $table->text('address');
            $table->string('postal_code');
            $table->decimal('total_price', 10, 2);
            $table->string('tid')->comment('Transaction ID');
            $table->string('payment_screenshot');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
