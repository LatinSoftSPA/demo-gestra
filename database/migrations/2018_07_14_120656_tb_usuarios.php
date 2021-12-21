<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prim_nombr')->default(false);
            $table->string('segu_nombr')->default(false);
            $table->string('apel_pater')->default(false);
            $table->string('apel_mater')->default(false);
            //$table->string('username')->unique();
            $table->string('docu_perso')->unique();
            $table->string('email')->unique();
            $table->string('rol');
            $table->string('password');

            $table->boolean('activo')->default(false);
            $table->boolean('online')->default(false);
            $table->string('foto_perfil')->default(null);

            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_logout')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
