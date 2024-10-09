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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cover_id')
                ->default(3)
                ->references('id')
                ->on('uploads');
            $table->string('name')->unique();
            $table->longText('description');
            $table->enum('status', [
                'published',
                'unpublished'
            ])->default('published');
            $table->foreignId('parent_id')
                ->nullable()
                ->references('id')
                ->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
