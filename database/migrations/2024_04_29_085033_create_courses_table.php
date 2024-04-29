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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->decimal('price');
            $table->integer('duration');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('rating_id');
            $table->unsignedBigInteger('instructor_id');
            $table->timestamps();

            $table->foreign('rating_id')->references('id')->on('rating');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('instructor_id')->references('id')->on('instructors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
