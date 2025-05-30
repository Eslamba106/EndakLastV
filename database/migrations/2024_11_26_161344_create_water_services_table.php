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
        Schema::create('water_services', function (Blueprint $table) {
            $table->id();
            $table->string('city')->nullable();
            $table->string('neighborhood')->nullable();
            $table->enum('status',['open' , 'close' , 'pending' , 'confirm']);
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->longText('notes')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_services');
    }
};
