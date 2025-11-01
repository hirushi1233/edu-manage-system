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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('teacher_id')->unique(); // Custom teacher code
            $table->string('name');
            $table->text('address')->nullable(); // Optional address
            $table->string('nic')->nullable()->unique(); // National ID, optional but unique
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            
            // Instead of storing subjects and grades as strings,
            // consider linking via relations in the future. For now, keep nullable strings
            $table->string('subject_1')->nullable();
            $table->string('subject_2')->nullable();
            $table->string('grade_1')->nullable();
            $table->string('grade_2')->nullable();
            
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
