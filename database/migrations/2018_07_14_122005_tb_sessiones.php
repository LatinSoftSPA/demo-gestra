<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbSessiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_sessiones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('docu_perso');
            $table->string('docu_empre');
            $table->dateTime('fech_inici')->nullable();
            $table->dateTime('fech_termi')->nullable();
            $table->string('ip')->nullable();
            $table->string('token')->nullable();
            $table->timestamps();

            $table->foreign('docu_perso')->references('docu_perso')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_sessiones');
    }
}
