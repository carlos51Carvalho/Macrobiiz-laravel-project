<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->increments('id_despesa');
            $table->unsignedInteger('id_colaborador');
            $table->text('descricao');
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
        Schema::dropIfExists('despesas');
    }
}
