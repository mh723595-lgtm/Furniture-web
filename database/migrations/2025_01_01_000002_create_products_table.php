<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('specification')->nullable();
            $table->string('material')->nullable();
            $table->string('dimension')->nullable();
            $table->string('color')->nullable();
            $table->decimal('price', 15, 2)->default(0);
            $table->decimal('discount_price', 15, 2)->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->string('sku')->unique()->nullable();
            $table->enum('status', ['active', 'inactive', 'draft'])->default('active');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_best_seller')->default(false);
            $table->string('thumbnail')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();

            $table->index(['status', 'is_featured']);
            $table->index(['status', 'is_best_seller']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
