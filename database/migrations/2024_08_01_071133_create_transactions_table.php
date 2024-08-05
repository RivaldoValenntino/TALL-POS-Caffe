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
            $table->foreignId('customer_id')->constrained()->nullOnDelete();
            $table->string('invoice_number')->unique();
            $table->longText('items');
            $table->integer('total');
            $table->text('description')->nullable();
            $table->integer('customers_pay')->nullable();
            $table->integer('change')->nullable();
            $table->enum('payment_method', ['cash', 'qris',])->nullable();
            $table->enum('status', ['process', 'done', 'cancelled'])->default('process')->nullable();
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
