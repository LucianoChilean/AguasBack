<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perfil_permisos extends Model
{
    use HasFactory;

    protected $fillable = [
        'perfil_id',
        'permiso_id',
    ];
}
