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
        Schema::create('conflict_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('recipient_name');
            $table->string('recipient_case_number');
            $table->string('conflict_case_number_1');
            $table->string('conflict_case_number_2');
            $table->unsignedBigInteger('case_hearing_id_1')->nullable();
            $table->unsignedBigInteger('case_hearing_id_2')->nullable();
            $table->dateTime('conflict_date_time');
            $table->dateTime('record_generated_at')->nullable();
            $table->dateTime('scheduled_send_date')->nullable();
            $table->enum('status', ['upcoming', 'history'])->default('upcoming');
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unique([ 'case_hearing_id_1','case_hearing_id_2','conflict_date_time' ], 'unique_conflict_pair');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conflict_logs');
    }
};
