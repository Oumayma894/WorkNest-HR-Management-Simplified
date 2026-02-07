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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
          

    $table->unsignedBigInteger('employee_id');
    $table->unsignedBigInteger('admin_id')->nullable(); // Only set after approval/rejection

    $table->string('leave_type');
    $table->integer('remaining_leave')->nullable();
    $table->date('date_from');
    $table->date('date_to');
    $table->integer('number_of_day');
    $table->enum('leave_day', ['half', 'full'])->nullable();
    $table->text('reason')->nullable();
    $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

    $table->timestamps();

    $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
    $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
