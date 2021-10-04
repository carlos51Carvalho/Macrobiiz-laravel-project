<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVencimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vencimentos', function (Blueprint $table) {
            $table->increments('id_vencimento');
            $table->unsignedInteger('id_colaborador');
            $table->date('data');
            $table->string('ficheiro');

            $table->timestamps();

            $table->foreign('id_colaborador')
                ->references('id_colaborador')->on('colaboradores')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vencimentos');
    }
}
