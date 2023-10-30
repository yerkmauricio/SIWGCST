<?php

namespace Database\Seeders;

use App\Models\Descuento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DescuentoSeeder extends Seeder
{
    
    public function run(): void
    {
        $descuentos = [
            ['nombre' => 'Verano', 'tipo' => 'temporada', 'porcentaje' => 10, 'f_registro' => now()],
            ['nombre' => 'Otoño', 'tipo' => 'temporada', 'porcentaje' => 15, 'f_registro' => now()],
            ['nombre' => 'Invierno', 'tipo' => 'temporada', 'porcentaje' => 20, 'f_registro' => now()],
            ['nombre' => 'personas israelitas', 'tipo' => 'israelitas', 'porcentaje' => 20, 'f_registro' => now()],
            ['nombre' => 'rebaja', 'tipo' => 'habitual', 'porcentaje' => 5, 'f_registro' => now()],
            ['nombre' => '4 personas', 'tipo' => 'cantidad', 'porcentaje' => 10, 'f_registro' => now()],
            ['nombre' => 'cliente concurrente', 'tipo' => 'cantidad', 'porcentaje' => 10, 'f_registro' => now()],
            ['nombre' => 'infante', 'tipo' => 'niño', 'porcentaje' => 5, 'f_registro' => now()],
        ];

        Descuento::insert($descuentos);
    }
}
