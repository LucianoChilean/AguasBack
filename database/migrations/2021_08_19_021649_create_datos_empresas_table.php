<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut',15);
            $table->string('nombre',150);
            $table->string('giro',200);
            $table->string('telefono',15);
            $table->string('direccion',250);
            $table->BigInteger('region_id');
            $table->foreign('region_id')->references('id')->on('region');
            $table->BigInteger('comuna_id');
            $table->foreign('comuna_id')->references('id')->on('comuna');
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
        Schema::dropIfExists('datos_empresas');
    }
}
