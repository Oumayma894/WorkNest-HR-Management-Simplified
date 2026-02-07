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
        Schema::create('holidays', function (Blueprint $table) {
           $table->id();
    $table->unsignedBigInteger('admin_id');
    $table->string('name');
    $table->string('type');
    $table->date('date');
    $table->timestamps();

    $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};
