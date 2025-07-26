<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProyectoUpdateController extends Controller
{
    public function __invoke(Request $r, Proyecto $proyecto)
    {
        $proyecto->update($r->all());
        return $proyecto->refresh();
    }
}

