<?php

namespace App\Models;

class Project
{

    // Simulación de una base de datos para proyectos.
    // En un caso real, esto sería reemplazado por una conexión a una base de datos.

    private static $data = [
        [
            'id'            => 1,
            'nombre'        => 'NOMBRE 1',
            'fecha_inicio'  => '2025-07-01',
            'estado'        => 'En progreso',
            'responsable'   => 'María',
            'monto'         => 12000,
        ],
        [
            'id'            => 2,
            'nombre'        => 'NOMBRE 2',
            'fecha_inicio'  => '2025-06-15',
            'estado'        => 'Completo',
            'responsable'   => 'Juan',
            'monto'         => 8000,
        ],
        [
            'id'            => 3,
            'nombre'        => 'NOMBRE 3',
            'fecha_inicio'  => '2025-07-10',
            'estado'        => 'Pendiente',
            'responsable'   => 'Ana',
            'monto'         => 15000,
        ],
    ];


    /* Obtener todos los proyectos */

    public static function all()
    {
        return self::$data;
    }


    /* Obtener un proyecto por ID */

    public static function find($id)
    {
        foreach (self::$data as $project) {
            if ($project['id'] == $id) {
                return $project;
            }
        }
        return null;
    }

    /* Crear un nuevo proyecto */

    public static function create(array $attributes)
    {
        $last = end(self::$data);
        $attributes['id'] = $last['id'] + 1;
        self::$data[] = $attributes;
        return $attributes;
    }

    /*Actualizar un proyecto existente */
    public static function update($id, array $attributes)
    {
        foreach (self::$data as &$project) {
            if ($project['id'] == $id) {
                $project = array_merge($project, $attributes);
                return $project;
            }
        }
        return null;
    }

    /* Eliminar un proyecto por ID */
    public static function delete($id)
    {
        foreach (self::$data as $index => $project) {
            if ($project['id'] == $id) {
                array_splice(self::$data, $index, 1);
                return true;
            }
        }
        return false;
    }
}
