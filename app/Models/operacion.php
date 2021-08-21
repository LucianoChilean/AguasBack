<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operacion extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha',
        'neto',
        'n_documento',
        'tipo_operacion_id',
        'tipo_documento_id',
        'impuesto_id',
        'datos_empresa_id',
        'detalle_compra_venta_id',
    ];
}
