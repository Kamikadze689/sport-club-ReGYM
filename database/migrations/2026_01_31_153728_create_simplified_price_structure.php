<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        
        Schema::create('price_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        
        Schema::create('price_category_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('price_categories')->onDelete('cascade');
            $table->string('name'); 
            $table->text('values')->nullable(); 
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        
        Schema::create('price_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('price_categories')->onDelete('cascade');
            $table->string('name'); 
            $table->json('property_values'); 
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('has_discount')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_items');
        Schema::dropIfExists('price_category_properties');
        Schema::dropIfExists('price_categories');
    }
};