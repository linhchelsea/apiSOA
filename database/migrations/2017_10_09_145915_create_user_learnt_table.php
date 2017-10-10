<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLearntTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserLearnt', function (Blueprint $table) {
            $table->unsignedInteger('IdUser');
            $table->unsignedInteger('IdLesson');
            $table->unsignedInteger('LessonPoint');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UserLearnt');
    }
}
