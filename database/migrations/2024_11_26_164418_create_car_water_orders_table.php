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
        Schema::create('car_water_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('car_water_services')->cascadeOnDelete()->nullable();
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
        Schema::dropIfExists('car_water_orders');
    }
};
