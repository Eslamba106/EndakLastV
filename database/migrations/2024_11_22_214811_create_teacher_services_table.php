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
        Schema::create('teacher_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status',['open' , 'close' , 'pending' , 'confirm']);
            $table->string('city')->nullable();
            $table->string('neighborhood')->nullable();
            $table->longText('notes')->nullable(); 
            $table->enum('gender' , ['male' , 'female'])->default('male');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_services');
    }
};
