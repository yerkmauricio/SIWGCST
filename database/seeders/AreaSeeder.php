<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    
    public function run(): void
    {
        $areas = [
            ['nombre' => 'area de comercializacion','tipo'=>'produccion', 'descripcion' => 'Es el departamento o sección de una empresa encargada de desarrollar estrategias para promocionar y vender los productos o servicios de la compañía. Esta área se enfoca en identificar oportunidades de mercado, analizar la competencia, establecer precios, realizar campañas publicitarias y mantener relaciones con los clientes.', 'estado' => 1, 'f_registro' => now()],
            ['nombre' => 'area de equipo','tipo'=>'logistica', 'descripcion' => ' Es el departamento o grupo encargado de gestionar y mantener el inventario de equipos, maquinarias o herramientas necesarias para el funcionamiento de la empresa. Esta área se encarga de adquirir los equipos, realizar su mantenimiento, supervisar su uso adecuado y garantizar su disponibilidad para las diferentes áreas de la organización.', 'estado' => 1, 'f_registro' => now()],
            ['nombre' => 'area de transporte','tipo'=>'servicio al cliente', 'descripcion' => 'Es el departamento o sección de una empresa dedicada a la logística y gestión del transporte de mercancías o personas. Esta área se encarga de planificar y coordinar los envíos, contratar servicios de transporte, asegurar la eficiencia en la distribución y cumplir con las regulaciones y normativas relacionadas al transporte.', 'estado' => 1, 'f_registro' => now()],
            ['nombre' => 'area de guiaje','tipo'=>'servicio al cliente', 'descripcion' => 'Es el departamento o grupo encargado de proporcionar guías especializados para acompañar y asistir a los clientes o turistas durante sus actividades o excursiones. Los guías brindan información, explicaciones y aseguran la seguridad de los visitantes en distintos lugares o recorridos.', 'estado' => 1, 'f_registro' => now()],
            ['nombre' => 'area de marketing','tipo'=>'marketing', 'descripcion' => 'Es el departamento o equipo responsable de planificar y ejecutar las estrategias de marketing de la empresa. Esta área se enfoca en identificar el público objetivo, diseñar campañas de publicidad y promoción, gestionar la presencia en medios digitales y tradicionales, y medir el impacto de las acciones de marketing.','estado' => 1, 'f_registro' => now()],
        ];
        Area::insert($areas);  
    }
}
