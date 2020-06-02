<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('idUser');
            $table->string('name', 50);
            $table->string('lastname', 50);
            $table->string('email', 50)->unique();
            $table->string('password', 255);
            $table->tinyInteger('role')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
