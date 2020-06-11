<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set', function (Blueprint $table) {
            $table->increments('idSet');
            $table->unsignedInteger('idOrder');
            $table->unsignedInteger('idArt');
            $table->integer('amount');
            $table->float('setPrice')->default(null)->nullable();
            $table->timestamps();
        });

        Schema::table('set', function (Blueprint $table) {
            $table->foreign('idOrder')
                ->references('idOrder')
                ->on('order')
                ->onUpdate('cascade');
        });

        Schema::table('set', function (Blueprint $table) {
            $table->foreign('idArt')
                ->references('idArt')
                ->on('article')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set');
    }
}
