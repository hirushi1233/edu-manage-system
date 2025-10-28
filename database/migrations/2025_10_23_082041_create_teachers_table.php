<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id')->unique();
            $table->string('name');
            $table->text('address');
            $table->string('nic');
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('subject_1')->nullable();
            $table->string('subject_2')->nullable();
            $table->string('grade_1')->nullable();
            $table->string('grade_2')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};