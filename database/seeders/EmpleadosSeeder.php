<?php

namespace Database\Seeders;

use App\Models\Empleados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empleados = [
            [
                'nombre' => 'Juan', 'apellidopaterno' => 'Pérez', 'apellidomaterno' => 'García',
                'dni' => '12345678', 'est_laboral' => 1, 'domicilio' => 'Av. Principal 123',
                'nacionalidad' => 'Boliviana', 'genero' => 1, 'whatsapp' => 111111111,
                'fnacimiento' => '1990-05-15', 'finicio' => '2021-01-10', 'fsuspension' => null,
                'foto' => 'ruta_foto1.jpg', 'cargo_id' => 1, 'n_jerarquico_id' => 2,
                'f_registro' => now(),
            ],
            [
                'nombre' => 'María', 'apellidopaterno' => 'López', 'apellidomaterno' => 'Sánchez',
                'dni' => '23456789', 'est_laboral' => 1, 'domicilio' => 'Calle 456',
                'nacionalidad' => 'Boliviana', 'genero' => 0, 'whatsapp' => 222222222,
                'fnacimiento' => '1988-10-20', 'finicio' => '2020-03-05', 'fsuspension' => null,
                'foto' => 'ruta_foto2.jpg', 'cargo_id' => 2, 'n_jerarquico_id' => 1,
                'f_registro' => now(),
            ],
            [
                'nombre' => 'Carlos', 'apellidopaterno' => 'Gómez', 'apellidomaterno' => 'Rodríguez',
                'dni' => '34567890', 'est_laboral' => 1, 'domicilio' => 'Calle 789',
                'nacionalidad' => 'Boliviana', 'genero' => 1, 'whatsapp' => 333333333,
                'fnacimiento' => '1995-02-25', 'finicio' => '2022-07-10', 'fsuspension' => null,
                'foto' => 'ruta_foto3.jpg', 'cargo_id' => 3, 'n_jerarquico_id' => 1,
                'f_registro' => now(),
            ],
            [
                'nombre' => 'Ana', 'apellidopaterno' => 'Martínez', 'apellidomaterno' => 'Pérez',
                'dni' => '45678901', 'est_laboral' => 1, 'domicilio' => 'Av. Bolívar 987',
                'nacionalidad' => 'Boliviana', 'genero' => 0, 'whatsapp' => 444444444,
                'fnacimiento' => '1993-09-12', 'finicio' => '2019-06-02', 'fsuspension' => null,
                'foto' => 'ruta_foto4.jpg', 'cargo_id' => 2, 'n_jerarquico_id' => 3,
                'f_registro' => now(),
            ],
            [
                'nombre' => 'David', 'apellidopaterno' => 'Hernández', 'apellidomaterno' => 'Pérez',
                'dni' => '67890123', 'est_laboral' => 1, 'domicilio' => 'Av. Sucre 456',
                'nacionalidad' => 'Boliviana', 'genero' => 1, 'whatsapp' => 666666666,
                'fnacimiento' => '1988-11-30', 'finicio' => '2018-02-15', 'fsuspension' => null,
                'foto' => 'ruta_foto6.jpg', 'cargo_id' => 2, 'n_jerarquico_id' => 1,
                'f_registro' => now(),
            ],
            [
                'nombre' => 'rudy', 'apellidopaterno' => 'mauricio', 'apellidomaterno' => 'montaño',
                'dni' => '8377021', 'est_laboral' => 1, 'domicilio' => 'lapaz',
                'nacionalidad' => 'boliviano', 'genero' => 1, 'whatsapp' => 5917912050,
                'fnacimiento' => '1999-11-22', 'finicio' => '2017-06-25', 'fsuspension' => null,
                'foto' => 'ruta_foto8.jpg', 'cargo_id' => 3, 'n_jerarquico_id' => 2,
                'f_registro' => now(),
            ],
            [
                'nombre' => 'daysi', 'apellidopaterno' => 'llusco', 'apellidomaterno' => 'candia',
                'dni' => '8377024', 'est_laboral' => 1, 'domicilio' => 'Av. Bolívar 567',
                'nacionalidad' => 'Boliviana', 'genero' => 1, 'whatsapp' => 888888888,
                'fnacimiento' => '2001-04-21', 'finicio' => '2017-06-25', 'fsuspension' => null,
                'foto' => 'ruta_foto8.jpg', 'cargo_id' => 3, 'n_jerarquico_id' => 2,
                'f_registro' => now(),
            ],
            [
                'nombre' => 'Javier', 'apellidopaterno' => 'Rodríguez', 'apellidomaterno' => 'López',
                'dni' => '89012345', 'est_laboral' => 1, 'domicilio' => 'Av. Bolívar 567',
                'nacionalidad' => 'Boliviana', 'genero' => 1, 'whatsapp' => 888888888,
                'fnacimiento' => '1985-09-12', 'finicio' => '2017-06-25', 'fsuspension' => null,
                'foto' => 'ruta_foto8.jpg', 'cargo_id' => 3, 'n_jerarquico_id' => 2,
                'f_registro' => now(),
            ],
        ];
        Empleados::insert($empleados);
    }
}
