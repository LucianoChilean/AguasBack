<?php

namespace App\Http\Controllers;

use App\Models\bodega;
use Illuminate\Http\{Request, Response};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BodegaController extends Controller
{
    public function index(){
        return bodega::all();
    }
}
