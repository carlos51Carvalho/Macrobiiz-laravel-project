<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDominiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dominios', function (Blueprint $table) {
            $table->increments('id_dominio');
            $table->unsignedInteger('id_cliente');
            $table->text('descricao');
            $table->boolean('status')->default(false);
            $table->date('data_inicio');
            $table->date('data_fim');

            $table->timestamps();

            $table->foreign('id_cliente')
                ->references('id_cliente')->on('clientes')
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
        Schema::dropIfExists('dominios');
    }
}
