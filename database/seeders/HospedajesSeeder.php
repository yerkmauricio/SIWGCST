<?php

namespace Database\Seeders;

use App\Models\Hospedajes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospedajesSeeder extends Seeder
{
    
    public function run(): void
    {
        $hospedajes = [
            ['nombre' => 'gloria', 'tipo' => 'hotel', 'empresa' => 'hotelera','precio' => 90, 'whatsapp' => '111111111', 'ubicacion'=>'la paz','foto' => 'ruta_imagen3.jpg', 'f_registro' => now()],
            ['nombre' => 'rits', 'tipo' => 'hotel', 'empresa' => 'hotelera','precio' => 90, 'whatsapp' => '111111111', 'ubicacion'=>'la paz','foto' => 'ruta_imagen3.jpg', 'f_registro' => now()],
            ['nombre' => 'canoa', 'tipo' => 'hotel', 'empresa' => 'hotelera','precio' => 90, 'whatsapp' => '111111111', 'ubicacion'=>'la paz','foto' => 'ruta_imagen3.jpg', 'f_registro' => now()],
            ['nombre' => 'hotel del mundo', 'tipo' => 'hotel', 'empresa' => 'hotelera','precio' => 90, 'whatsapp' => '111111111', 'ubicacion'=>'la paz','foto' => 'ruta_imagen3.jpg', 'f_registro' => now()],
            ['nombre' => 'chongo', 'tipo' => 'hotel', 'empresa' => 'hotelera','precio' => 90, 'whatsapp' => '111111111', 'ubicacion'=>'la paz','foto' => 'ruta_imagen3.jpg', 'f_registro' => now()],
            ['nombre' => 'lapaz', 'tipo' => 'hotel', 'empresa' => 'hotelera','precio' => 90, 'whatsapp' => '111111111', 'ubicacion'=>'la paz','foto' => 'ruta_imagen3.jpg', 'f_registro' => now()],
            ['nombre' => 'oasis', 'tipo' => 'hotel', 'empresa' => 'hotelera','precio' => 90, 'whatsapp' => '111111111', 'ubicacion'=>'la paz','foto' => 'ruta_imagen3.jpg', 'f_registro' => now()],

        ];

        Hospedajes::insert($hospedajes);
    }
}
