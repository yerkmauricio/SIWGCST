<?php

namespace Database\Seeders;

use App\Models\Transporte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransporteSeeder extends Seeder
{

    public function run(): void
    {
        $transportes = [
            ['nombre' => 'keyton', 'tipo' => 'vagone', 'empresa' => 'Empresa Taciz', 'npasajero' => 4, 'precio' => 50, 'whatsapp' => '111111111', 'foto' => 'ruta_imagen3.jpg', 'f_registro' => now()],
            ['nombre' => 'minibús', 'tipo' => 'Micro', 'empresa' => 'Empresa Ninibús', 'npasajero' => 25, 'precio' => 80, 'whatsapp' => '222222222', 'foto' => 'ruta_imagen4.jpg', 'f_registro' => now()],
            ['nombre' => 'Expreso', 'tipo' => 'Bus', 'empresa' => 'Empresa Expreso Tarija', 'npasajero' => 40, 'precio' => 120, 'whatsapp' => '333333333', 'foto' => 'ruta_imagen5.jpg', 'f_registro' => now()],
            ['nombre' => 'Flota', 'tipo' => 'Bus', 'empresa' => 'Empresa Flota Yungueña', 'npasajero' => 60, 'precio' => 180, 'whatsapp' => '444444444', 'foto' => 'ruta_imagen6.jpg', 'f_registro' => now()],
            ['nombre' => 'PumaKatari', 'tipo' => 'Bus', 'empresa' => 'Empresa PumaKatari', 'npasajero' => 50, 'precio' => 150, 'whatsapp' => '555555555', 'foto' => 'ruta_imagen7.jpg', 'f_registro' => now()],
            ['nombre' => 'bus', 'tipo' => 'Taxi', 'empresa' => 'Empresa Taxis Cruceños', 'npasajero' => 4, 'precio' => 60, 'whatsapp' => '666666666', 'foto' => 'ruta_imagen8.jpg', 'f_registro' => now()],
            ['nombre' => 'micro', 'tipo' => 'Bus', 'empresa' => 'Empresa Flota La Paz', 'npasajero' => 40, 'precio' => 130, 'whatsapp' => '777777777', 'foto' => 'ruta_imagen9.jpg', 'f_registro' => now()],
            ['nombre' => 'hilux', 'tipo' => 'Bus', 'empresa' => 'Empresa Expreso Oruro', 'npasajero' => 35, 'precio' => 100, 'whatsapp' => '888888888', 'foto' => 'ruta_imagen10.jpg', 'f_registro' => now()],

        ];

        Transporte::insert($transportes);
    }
}
