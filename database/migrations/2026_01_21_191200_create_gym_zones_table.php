<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gym_zones', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('color')->default('#3b82f6');
            $table->string('image')->nullable(); 
            $table->integer('grid_x')->default(0);
            $table->integer('grid_y')->default(0);
            $table->integer('width')->default(4);
            $table->integer('height')->default(3);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gym_zones');
    }
};