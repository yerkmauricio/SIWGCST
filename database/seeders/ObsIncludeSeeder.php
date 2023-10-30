<?php

namespace Database\Seeders;

use App\Models\Obs_include;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObsIncludeSeeder extends Seeder
{
     
    public function run(): void
    {
        $obs_includes = [
            ['nombre' => 'almuerzo','descripcion' => 'ningun tipo de restriccion en los alimentos','f_registro' => now()],
            ['nombre' => 'equipo','descripcion' => ' sigue un régimen alimentario basado en el consumo de frutas, verduras y legumbres','f_registro' => now()],
            ['nombre' => 'snak','descripcion' => 'sujeto que no ingiere productos alimenticios de origen animal.','f_registro' => now()],
            ['nombre' => 'sobenir','descripcion' => ' alimentos que se preparan de acuerdo a normas dietéticas judías, las cuales son permisibles para el consumo, puesto que cumplen con los requisitos de la dieta de la Biblia Hebrea.','f_registro' => now()],
           
        ];

        Obs_include::insert($obs_includes);  
    }
}
