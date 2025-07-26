<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;

class ProyectoShowController extends Controller
{
    public function __invoke($id)
    {
        return Proyecto::find($id);
    }
}
