<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->integer('neto');
            $table->integer('n_documento');
            $table->unsignedBigInteger('tipo_operacion');
            $table->foreign('tipo_operacion_id')->references('id')->on('tipo_operacion');
            $table->unsignedBigInteger('tipo_documento');
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento');
            $table->unsignedBigInteger('impuesto');
            $table->foreign('impuesto_id')->references('id')->on('impuesto');
            $table->unsignedBigInteger('datos_empresa');
            $table->foreign('datos_empresa_id')->references('id')->on('datos_empresa');
            $table->unsignedBigInteger('detalle_compra_venta');
            $table->foreign('detalle_compra_venta_id')->references('id')->on('detalle_compra_venta');
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
        Schema::dropIfExists('operacions');
    }
}
