<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegurosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguros', function (Blueprint $table) {
            $table->increments('id_seguro');
            $table->unsignedInteger('id_colaborador');
            $table->text('descricao');
            $table->date('data_inicio');
            $table->date('data_fim');
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
        Schema::dropIfExists('seguros');
    }
}
