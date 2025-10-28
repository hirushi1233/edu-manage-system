<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // Drop old text columns if they exist
            if (Schema::hasColumn('teachers', 'subject_1')) {
                $table->dropColumn('subject_1');
            }
            if (Schema::hasColumn('teachers', 'subject_2')) {
                $table->dropColumn('subject_2');
            }
        });
        
        Schema::table('teachers', function (Blueprint $table) {
            // Add new foreign key columns
            $table->unsignedBigInteger('subject_1_id')->nullable()->after('phone_2');
            $table->unsignedBigInteger('subject_2_id')->nullable()->after('subject_1_id');
            
            // Add foreign key constraints
            $table->foreign('subject_1_id')->references('id')->on('subjects')->onDelete('set null');
            $table->foreign('subject_2_id')->references('id')->on('subjects')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['subject_1_id']);
            $table->dropForeign(['subject_2_id']);
            
            // Then drop columns
            $table->dropColumn(['subject_1_id', 'subject_2_id']);
            
            // Restore old text columns
            $table->string('subject_1')->nullable();
            $table->string('subject_2')->nullable();
        });
    }
};