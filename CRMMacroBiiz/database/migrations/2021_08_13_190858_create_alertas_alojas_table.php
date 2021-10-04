<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertasAlojasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alertas_alojas', function (Blueprint $table) {
            $table->increments('id_alerta');
            $table->unsignedInteger('id_alojamento');
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->foreign('id_alojamento')
                ->references('id_alojamento')->on('alojamentos')
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
        Schema::dropIfExists('alertas_alojas');
    }
}
