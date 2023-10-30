<?php

namespace Database\Seeders;

use App\Models\Destinos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinosSeeder extends Seeder
{

    public function run(): void
    {
        $destinos = [
            ['nombre' => 'Illimani', 'ubicacion' => 'Cordillera Real', 'entrada' => 30, 'categoria' => 'Aventura', 'descripcion' => 'Explora la majestuosa montaña Illimani en la Cordillera Real', 'distancia' => '50','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen10.jpg', 'f_registro' => now()],
            ['nombre' => 'Huayna Potosí', 'ubicacion' => 'Cordillera Real', 'entrada' => 50, 'categoria' => 'Aventura', 'descripcion' => 'Cumbre icónica para montañistas', 'distancia' => '50','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen11.jpg', 'f_registro' => now()],
            ['nombre' => 'Pico Austria', 'ubicacion' => 'Cordillera Real', 'entrada' => 45, 'categoria' => 'Aventura', 'descripcion' => 'Desafío alpinístico con vistas impresionantes', 'distancia' => '60','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen12.jpg', 'f_registro' => now()],
            ['nombre' => 'Glacial Italia', 'ubicacion' => 'La Paz', 'entrada' => 25, 'categoria' => 'Naturaleza', 'descripcion' => 'Explora el hermoso glaciar Italia en La Paz', 'distancia' => '30','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen13.jpg', 'f_registro' => now()],
            ['nombre' => 'Condoriri', 'ubicacion' => 'Cordillera Real', 'entrada' => 35, 'categoria' => 'Aventura', 'descripcion' => 'Rodeado de impresionantes lagunas y picos nevados', 'distancia' => '70','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen14.jpg', 'f_registro' => now()],
            ['nombre' => 'Glacial del Sur', 'ubicacion' => 'Cordillera Real', 'entrada' => 40, 'categoria' => 'Aventura', 'descripcion' => 'Desafío alpinístico en un entorno espectacular', 'distancia' => '80','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen15.jpg', 'f_registro' => now()],
            ['nombre' => 'Chacaltaya', 'ubicacion' => 'La Paz', 'entrada' => 15, 'categoria' => 'Aventura', 'descripcion' => 'Disfruta del esquí y las vistas desde Chacaltaya', 'distancia' => '25','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen16.jpg', 'f_registro' => now()],
            ['nombre' => 'Sajama', 'ubicacion' => 'Parque Nacional Sajama', 'entrada' => 30, 'categoria' => 'Naturaleza', 'descripcion' => 'Explora la naturaleza en el parque nacional más antiguo de Bolivia', 'distancia' => '300','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen17.jpg', 'f_registro' => now()],
            ['nombre' => 'Taquesi', 'ubicacion' => 'La Paz', 'entrada' => 10, 'categoria' => 'Senderismo', 'descripcion' => 'Ruta de senderismo con hermosas vistas', 'distancia' => '50','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen18.jpg', 'f_registro' => now()],
            ['nombre' => 'Choro', 'ubicacion' => 'La Paz', 'entrada' => 18, 'categoria' => 'Senderismo', 'descripcion' => 'Emocionante experiencia de senderismo en la Ruta del Choro', 'distancia' => '70','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen19.jpg', 'f_registro' => now()],
            ['nombre' => 'Death Road', 'ubicacion' => 'Cerca de La Paz', 'entrada' => 30, 'categoria' => 'Aventura', 'descripcion' => 'Descenso en bicicleta por la Carretera de la Muerte', 'distancia' => '50','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen20.jpg', 'f_registro' => now()],
            ['nombre' => 'Uyuni', 'ubicacion' => 'Departamento de Potosí', 'entrada' => 40, 'categoria' => 'Aventura', 'descripcion' => 'Explora el famoso Salar de Uyuni y sus paisajes únicos', 'distancia' => '400','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen21.jpg', 'f_registro' => now()],
            ['nombre' => 'Copacabana', 'ubicacion' => 'Orillas del Lago Titicaca', 'entrada' => 10, 'categoria' => 'Relax', 'descripcion' => 'Relájate en este encantador pueblo a orillas del lago', 'distancia' => '150','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen22.jpg', 'f_registro' => now()],
            ['nombre' => 'Tiahuanaco', 'ubicacion' => 'A unos 70 km de La Paz', 'entrada' => 15, 'categoria' => 'Cultura', 'descripcion' => 'Visita las ruinas arqueológicas de Tiwanaku', 'distancia' => '70','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen23.jpg', 'f_registro' => now()],
            ['nombre' => 'Sorata', 'ubicacion' => 'Cordillera Real', 'entrada' => 25, 'categoria' => 'Naturaleza', 'descripcion' => 'Encantador valle al pie del Nevado Illampu', 'distancia' => '120','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen24.jpg', 'f_registro' => now()],
            ['nombre' => 'La Paz', 'ubicacion' => 'La Paz', 'entrada' => 5, 'categoria' => 'Cultura', 'descripcion' => 'Descubre la capital de Bolivia y su rica cultura', 'distancia' => '0','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen25.jpg', 'f_registro' => now()],
            ['nombre' => 'El Alto', 'ubicacion' => 'El Alto', 'entrada' => 5, 'categoria' => 'Cultura', 'descripcion' => 'Visita la ciudad vecina de La Paz con su ajetreo único', 'distancia' => '10','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen26.jpg', 'f_registro' => now()],
            ['nombre' => 'Valle de las Ánimas', 'ubicacion' => 'Cerca de La Paz', 'entrada' => 10, 'categoria' => 'Naturaleza', 'descripcion' => 'Explora el misterioso Valle de las Ánimas', 'distancia' => '15','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen27.jpg', 'f_registro' => now()],
            ['nombre' => 'Rurrenabaque', 'ubicacion' => 'Región Amazónica', 'entrada' => 40, 'categoria' => 'Naturaleza', 'descripcion' => 'Explora la selva amazónica desde Rurrenabaque', 'distancia' => '400','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen28.jpg', 'f_registro' => now()],
            ['nombre' => 'Coroico', 'ubicacion' => 'Yungas de La Paz', 'entrada' => 15, 'categoria' => 'Naturaleza', 'descripcion' => 'Disfruta de la naturaleza en el pintoresco Coroico', 'distancia' => '90','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen29.jpg', 'f_registro' => now()],
            ['nombre' => 'Toro Toro', 'ubicacion' => 'Potosí', 'entrada' => 25, 'categoria' => 'Aventura', 'descripcion' => 'Explora las formaciones geológicas únicas de Toro Toro', 'distancia' => '400','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen30.jpg', 'f_registro' => now()],
            ['nombre' => 'Machu Picchu', 'ubicacion' => 'Perú', 'entrada' => 80, 'categoria' => 'Historia', 'descripcion' => 'Visita la icónica ciudad inca de Machu Picchu', 'distancia' => '500','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen31.jpg', 'f_registro' => now()],
            ['nombre' => 'Pico Alpamayo', 'ubicacion' => 'Cordillera Blanca', 'entrada' => 60, 'categoria' => 'Aventura', 'descripcion' => 'Desafía al hermoso Pico Alpamayo en Perú', 'distancia' => '800','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen32.jpg', 'f_registro' => now()],
            ['nombre' => 'Pampas', 'ubicacion' => 'Región Amazónica', 'entrada' => 35, 'categoria' => 'Naturaleza', 'descripcion' => 'Explora las vastas Pampas de la región amazónica', 'distancia' => '500','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen33.jpg', 'f_registro' => now()],
            ['nombre' => 'Jungla', 'ubicacion' => 'Región Amazónica', 'entrada' => 30, 'categoria' => 'Naturaleza', 'descripcion' => 'Adéntrate en la exuberante jungla boliviana', 'distancia' => '300','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen34.jpg', 'f_registro' => now()],
            ['nombre' => 'Charquini', 'ubicacion' => 'Cordillera Real', 'entrada' => 40, 'categoria' => 'Aventura', 'descripcion' => 'Desafía al monte Charquini y disfruta de vistas panorámicas', 'distancia' => '45','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen35.jpg', 'f_registro' => now()],
            ['nombre' => 'Takesi', 'ubicacion' => 'La Paz', 'entrada' => 15, 'categoria' => 'Senderismo', 'descripcion' => 'Recorrido de senderismo por el Camino de Takesi', 'distancia' => '60','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen36.jpg', 'f_registro' => now()],
            ['nombre' => 'Cañón Palca y Jambo', 'ubicacion' => 'La Paz', 'entrada' => 25, 'categoria' => 'Naturaleza', 'descripcion' => 'Explora el impresionante Cañón Palca y Jambo', 'distancia' => '20','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen37.jpg', 'f_registro' => now()],
            ['nombre' => 'Pequeño Alpamayo', 'ubicacion' => 'Cordillera Real', 'entrada' => 55, 'categoria' => 'Aventura', 'descripcion' => 'Ascenso emocionante para montañistas', 'distancia' => '65','altura' =>'1000','clima'=>'frio', 'whatsapp' => '1111', 'foto' => 'ruta_imagen38.jpg', 'f_registro' => now()],
        ];

        Destinos::insert($destinos);
    }
}
