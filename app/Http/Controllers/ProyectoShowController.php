<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class ProyectoShowController extends Controller
{
    public function __invoke(Proyecto $proyecto) { return $proyecto; }
}
