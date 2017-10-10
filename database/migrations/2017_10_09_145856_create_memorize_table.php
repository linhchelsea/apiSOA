<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemorizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Memorize', function (Blueprint $table) {
            $table->increments('Id');
            $table->unsignedInteger('IdUser');
            $table->unsignedInteger('IdVocabulary');
            $table->string('Content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Memorize');
    }
}
