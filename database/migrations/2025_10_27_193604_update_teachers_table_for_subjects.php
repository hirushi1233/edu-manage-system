<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // Drop old text columns
            $table->dropColumn(['subject_1', 'subject_2']);
            
            // Add new foreign key columns
            $table->foreignId('subject_1_id')->nullable()->constrained('subjects')->onDelete('set null');
            $table->foreignId('subject_2_id')->nullable()->constrained('subjects')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign(['subject_1_id']);
            $table->dropForeign(['subject_2_id']);
            $table->dropColumn(['subject_1_id', 'subject_2_id']);
            
            $table->string('subject_1')->nullable();
            $table->string('subject_2')->nullable();
        });
    }
};