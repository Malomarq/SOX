<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('idOrder');
            $table->unsignedInteger('idUser');
            $table->string('date', 10)->default(null)->nullable();
            $table->text('address')->default(null)->nullable();
            $table->string('pay', 10)->default(null)->nullable();
            $table->tinyInteger('open');
            $table->timestamps();
        });

        Schema::table('order', function (Blueprint $table) {
            $table->foreign('idUser')
                ->references('idUser')
                ->on('user')
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
        Schema::dropIfExists('order');
    }
}
