<?php

namespace Database\Seeders;

use App\Models\Obs_noinclude;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObsNoincludeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obs_noincludes = [
            ['nombre' => 'entrada','descripcion' => 'ningun tipo de restriccion en los alimentos','f_registro' => now()],
            ['nombre' => ' deayuno','descripcion' => ' sigue un régimen alimentario basado en el consumo de frutas, verduras y legumbres','f_registro' => now()],
            ['nombre' => 'baterias AAA','descripcion' => 'sujeto que no ingiere productos alimenticios de origen animal.','f_registro' => now()],
            ['nombre' => 'Gastos extras','descripcion' => ' alimentos que se preparan de acuerdo a normas dietéticas judías, las cuales son permisibles para el consumo, puesto que cumplen con los requisitos de la dieta de la Biblia Hebrea.','f_registro' => now()],
           
        ];

        Obs_noinclude::insert($obs_noincludes);  
    }
}
