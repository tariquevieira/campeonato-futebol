<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('time_mandante_id');
            $table->unsignedBigInteger('time_visitante_id');
            $table->unsignedBigInteger('campeonato_id');
            $table->enum('fase', ['f', 'sf', 't', 'q']);
            $table->integer('gols_time_mandante')->default(0);
            $table->integer('gols_time_visitante')->default(0);
            $table->timestamps();

            $table->foreign('time_mandante_id')->references('id')->on('times');
            $table->foreign('time_visitante_id')->references('id')->on('times');
            $table->foreign('campeonato_id')->references('id')->on('campeonatos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jogos');
    }
};