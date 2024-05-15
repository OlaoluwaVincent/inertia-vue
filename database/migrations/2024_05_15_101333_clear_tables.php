<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $this->disableForeignKeyConstraints();

        DB::table('users')->truncate();
        DB::table('cache')->truncate();
        DB::table('jobs')->truncate();
        DB::table('courses')->truncate();
        DB::table('lessons')->truncate();
        DB::table('instructors')->truncate();
        DB::table('comments')->truncate();
        DB::table('reviews')->truncate();
        DB::table('categories')->truncate();
        DB::table('ratings')->truncate();
        DB::table('compliments')->truncate();

        $this->enableForeignKeyConstraints();
    }

    public function down()
    {
        // You can add rollback logic here if needed
    }

    private function disableForeignKeyConstraints()
    {
        Schema::disableForeignKeyConstraints();
    }

    private function enableForeignKeyConstraints()
    {
        Schema::enableForeignKeyConstraints();
    }
};
