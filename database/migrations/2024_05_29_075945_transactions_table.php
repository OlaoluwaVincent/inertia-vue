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
        Schema::create("transactions", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->integer("amount");
            $table->integer("transaction_id");
            $table->integer("customer_id");
            $table->string("transaction_ref");
            $table->string("status");
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('course_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
