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
        Schema::create('employees', function (Blueprint $table) {
    $table->id();
    $table->string('employee_code')->unique();
    $table->string('name');
    $table->string('designation');
    $table->string('email')->unique();
    $table->string('phone')->nullable();
    $table->string('location')->nullable();
    $table->decimal('experience', 4, 1)->nullable(); // e.g., 5.5 years
    $table->date('joining_date');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
