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
        Schema::create('follow_camera_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('follow_camera_services')->cascadeOnDelete()->nullable();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('service_provider_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status' , ['pending' , 'completed' , 'cancel']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_camera_orders');
    }
};