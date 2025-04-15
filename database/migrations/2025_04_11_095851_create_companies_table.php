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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_subscription_plans_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('total_clients')->default(0);
            $table->integer('total_lawyers')->default(0);
            $table->integer('total_conflict_sent')->default(0);
            $table->enum('status', ['active', 'inactive']);
            $table->foreign('company_subscription_plans_id')->references('id')->on('company_subscription_plans')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
