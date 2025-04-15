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
        Schema::create('case_management', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('lawyer_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('court_id');
            $table->boolean('incarcerated')->default(false);
            $table->string('case_number');
            $table->date('date_of_arrest')->nullable();
            $table->date('date_of_indictment')->nullable();
            $table->string('judge')->nullable();
            $table->string('country')->nullable();
            $table->date('filling_date')->nullable();
            $table->string('calendar_clerk_name')->nullable();
            $table->string('calendar_clerk_email')->nullable();
            $table->string('opposing_counsel_name')->nullable();
            $table->string('opposing_counsel_email')->nullable();
            $table->string('clerk_of_court_name')->nullable();
            $table->string('clerk_of_court_email')->nullable();
            $table->string('court_date_expected_time_to_resolve')->nullable();
            $table->timestamps();
            $table->foreign('court_id')->references('id')->on('courts')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('lawyer_id')->references('id')->on('lawyers')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_management');
    }
};
