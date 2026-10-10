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
        Schema::create('officers', function (Blueprint $table) {
            $table->id();
            $table->string('officer_name');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->date('dob');
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('address');
            $table->date('hire_date');
            $table->decimal('salary', 10, 2);
            $table->enum('status', ['Active', 'Inactive', 'Resigned'])->default('Active');
            $table->foreignId('department_id')->constrained('departments')->restrictOnDelete();
            $table->foreignId('position_id')->constrained('positions')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officers');
    }
};
