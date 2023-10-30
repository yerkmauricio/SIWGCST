<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\N_jerarquico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NJerarquicoSeeder extends Seeder
{
     
    public function run(): void
    {
        $n_jerarquico = [
            ['nombre' => 'administrador', 'descripcion' => 'encargado del sistema', 'n_orden' => 2, 'n_superior' => 1, 'f_registro' => now()],
            ['nombre' => 'gerente propietario', 'descripcion' => 'El Gerente Propietario es el máximo responsable de la empresa o negocio. Es el dueño o accionista principal y tiene la autoridad para tomar decisiones estratégicas y operativas. Su rol implica liderar, planificar, coordinar y supervisar todas las áreas del negocio, buscando el crecimiento y el éxito de la empresa.', 'n_orden' => 1, 'n_superior' => 0, 'f_registro' => now()],
            ['nombre' => 'gerente de area', 'descripcion' => 'El Gerente de Área es responsable de supervisar y dirigir un área o departamento específico dentro de la empresa. Su función es asegurar que las operaciones en esa área se desarrollen de manera eficiente y que se cumplan los objetivos establecidos. Reporta directamente al Gerente Propietario o a otro nivel superior de gestión.', 'n_orden' => 2, 'n_superior' => 1, 'f_registro' => now()],
            ['nombre' => 'supervisor', 'descripcion' => 'El Supervisor es el encargado de supervisar y coordinar las actividades diarias de un equipo o grupo de empleados en un área determinada. Su papel es garantizar que las tareas se completen adecuadamente, mantener la productividad y la calidad del trabajo, y resolver cualquier problema que surja durante el proceso.', 'n_orden' => 3, 'n_superior' => 2, 'f_registro' => now()],
            ['nombre' => 'empleado', 'descripcion' => 'El Empleado es un miembro del equipo que tiene tareas y responsabilidades específicas dentro de la empresa. Trabaja bajo la supervisión del Gerente de Área o del Supervisor y se encarga de cumplir con sus funciones asignadas. Su rol contribuye al funcionamiento general de la organización.', 'n_orden' => 4, 'n_superior' => 3, 'f_registro' => now()],
            ['nombre' => 'pasante', 'descripcion' => 'Un Pasante es un estudiante o recién graduado que realiza una pasantía en la empresa para adquirir experiencia práctica en su campo de estudio. Aunque no tiene la misma responsabilidad que un empleado a tiempo completo, el pasante contribuye con su trabajo y aprendizaje durante el período de pasantía.', 'n_orden' => 5, 'n_superior' => 4, 'f_registro' => now()],
        ];
        
        N_jerarquico::insert($n_jerarquico);
    }
}
