<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perfil_usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'perfil_id',
        'users_id',
    ];
}
