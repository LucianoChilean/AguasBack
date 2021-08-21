<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCompraVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_compra_ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedor');
            $table->string('token_cliente',250);
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
        Schema::dropIfExists('detalle_compra_ventas');
    }
}
