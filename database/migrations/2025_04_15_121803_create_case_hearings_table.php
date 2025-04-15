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
        Schema::create('case_hearings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('court_id');
            $table->unsignedBigInteger('case_management_id');
            $table->date('hearing_date');
            $table->time('hearing_time');
            $table->string('nature_of_court_date')->nullable();
            $table->timestamps();
            $table->foreign('court_id')->references('id')->on('courts')->onDelete('cascade');
            $table->foreign('case_management_id')->references('id')->on('case_management')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_hearings');
    }
};
