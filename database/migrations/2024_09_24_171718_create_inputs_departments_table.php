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
        Schema::create('inputs_departments', function (Blueprint $table) {
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->foreignId('inputs_id')->constrained('inputs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inputs_departments');
    }
};