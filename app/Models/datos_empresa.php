<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datos_empresa extends Model
{
    use HasFactory;
       
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rut',
        'nombre',
        'giro',
        'telefono',
        'direccion',
        'region_id',
        'comuna_id'
    ];
}
