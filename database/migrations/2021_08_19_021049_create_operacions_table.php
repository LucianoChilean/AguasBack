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
            $table->BigInteger('tipo_operacion_id');
            $table->foreign('tipo_operacion_id')->references('id')->on('tipo_operacion');
            $table->BigInteger('tipo_documento_id');
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento');
            $table->BigInteger('impuesto_id');
            $table->foreign('impuesto_id')->references('id')->on('impuesto');
            $table->BigInteger('datos_empresa_id');
            $table->foreign('datos_empresa_id')->references('id')->on('datos_empresa');
            $table->BigInteger('detalle_compra_venta_id');
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
