<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->unsignedSmallInteger('pts')->default(0);
            $table->unsignedSmallInteger('p')->default(0);
            $table->unsignedSmallInteger('w')->default(0);
            $table->unsignedSmallInteger('d')->default(0);
            $table->unsignedSmallInteger('l')->default(0);
            $table->smallInteger('gd')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
