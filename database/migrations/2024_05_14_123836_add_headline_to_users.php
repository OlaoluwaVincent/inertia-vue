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
        Schema::table('users', function (Blueprint $table) {
            $table->string('headline')->default('');
            $table->text('professional_experience')->default('');
            $table->json('expertise')->nullable();
            $table->json('socials')->nullable();
            $table->json('languages')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('headline')->default('');
            $table->text('professional_experience')->default('');
            $table->json('expertise')->nullable();
            $table->json('socials')->nullable();
            $table->json('languages')->nullable();
        });
    }
};
