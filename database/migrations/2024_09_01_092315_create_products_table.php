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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cover_id')
                ->default(2)
                ->references('id')
                ->on('uploads');
            $table->string('name');
            $table->longText('description');
            $table->integer('slug')->unique();
            $table->string('barcode')->unique();
            $table->boolean('allow_backorders')->default(true);
            $table->integer('shelf_quantity');
            $table->integer('warehouse_quantity')->default(0);
            $table->integer('rating')->default(0);
            $table->foreignId('category_id')
                ->nullable()
                ->references('id')
                ->on('categories');
            $table->foreignId('store_id')
                ->nullable()
                ->references('id')
                ->on('stores');
            $table->foreignId('shelf_id')
                ->nullable()
                ->references('id')
                ->on('shelves');
            $table->integer('retail_price_in_naira');
            $table->integer('sale_price_in_naira');
            $table->integer('discount')->default(0);
            $table->enum('discount_type', [
                'none',
                'percentage',
                'fixed'
            ])->default('percentage');
            $table->enum('template', [
                'default',
                'electronics',
                'furniture',
                'stationery',
                'fashion'
            ])->default('default');
            $table->enum('status', [
                'public',
                'hidden'
            ])->default('public');
            $table->boolean('physical')->default(true);
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->integer('width')->nullable();
            $table->integer('length')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
