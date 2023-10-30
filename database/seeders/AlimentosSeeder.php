<?php

namespace Database\Seeders;

use App\Models\Alimentos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlimentosSeeder extends Seeder
{
   
    public function run(): void
    {
        $alimentos = [
            ['nombre' => 'regular','descripcion' => 'ningun tipo de restriccion en los alimentos','f_registro' => now()],
            ['nombre' => 'vegetariano','descripcion' => ' sigue un régimen alimentario basado en el consumo de frutas, verduras y legumbres','f_registro' => now()],
            ['nombre' => 'vegano','descripcion' => 'sujeto que no ingiere productos alimenticios de origen animal.','f_registro' => now()],
            ['nombre' => 'kosher','descripcion' => ' alimentos que se preparan de acuerdo a normas dietéticas judías, las cuales son permisibles para el consumo, puesto que cumplen con los requisitos de la dieta de la Biblia Hebrea.','f_registro' => now()],
            ['nombre' => 'libre de gluten','descripcion' => ' Una alimentación sin gluten es aquella que elimina las proteínas del gluten que se encuentran en los alimentos para evitar los efectos secundarios de la sensibilidad al gluten o enfermedades basadas en el gluten, como la celiaquía.','f_registro' => now()],
            ['nombre' => 'celiacos','descripcion' => 'Celíaco es aquel que sufre la enfermedad celíaca o celiaquía. Las personas con este padecimiento tienen una intolerancia permanente al gluten (conjunto de proteínas que se encuentran en el trigo, la avena, la cebada y el centeno).','f_registro' => now()],
        ];

        Alimentos::insert($alimentos);
    }
}
