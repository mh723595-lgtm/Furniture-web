<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('showrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code')->nullable();
            $table->string('whatsapp_number');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('operational_hours')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('gmaps_embed')->nullable();
            $table->string('gmaps_url')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('showrooms');
    }
};
