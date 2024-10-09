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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')
                ->references('id')
                ->on('users');
            $table->foreignId('handler_id')
                ->nullable()
                ->references('id')
                ->on('users');
            $table->enum('status', [
                'completed',
                'failed',
                'cancelled',
                'processing',
                'expired'
            ])->default('processing');
            $table->integer('total_cost');
            $table->foreignId('billing_address_id')
                ->references('id')
                ->on('billing_addresses');
            $table->enum('payment_method', [
                'cash_on_delivery',
                'credit_card',
                'bank_transfer'
            ])->default('bank_transfer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
