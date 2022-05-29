<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('week');
            $table->unsignedSmallInteger('host_goals')->default(0);
            $table->unsignedSmallInteger('guest_goals')->default(0);

            $table->foreignId('host_id')
                ->constrained('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('guest_id')
                ->constrained('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['host_id', 'guest_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
