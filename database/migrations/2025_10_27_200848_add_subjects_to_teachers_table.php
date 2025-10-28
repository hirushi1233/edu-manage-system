<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('teachers', function (Blueprint $table) {
        $table->unsignedBigInteger('subject_1_id')->nullable();
        $table->unsignedBigInteger('subject_2_id')->nullable();

        // Optional: add foreign keys if you have subjects table
        $table->foreign('subject_1_id')->references('id')->on('subjects')->onDelete('set null');
        $table->foreign('subject_2_id')->references('id')->on('subjects')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('teachers', function (Blueprint $table) {
        $table->dropForeign(['subject_1_id']);
        $table->dropForeign(['subject_2_id']);
        $table->dropColumn(['subject_1_id', 'subject_2_id']);
    });
}

};
