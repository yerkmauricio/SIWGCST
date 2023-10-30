<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{

    public function run(): void
    {
        $cargos = [

            ['nombre' => 'Gerente de la Agencia', 'descripcion' => 'Encargado de la gestión y administración general de la agencia de viajes.', 'salario' => 5000, 'horario' => 8, 'area_id' => 1, 'n_jerarquico_id' => 1, 'f_registro' => now()],
            ['nombre' => 'Coordinador de Viajes', 'descripcion' => 'Responsable de planificar y coordinar los itinerarios y servicios para los clientes.', 'salario' => 2500, 'horario' => 8, 'area_id' => 1, 'n_jerarquico_id' => 2, 'f_registro' => now()],
            ['nombre' => 'Asesor de Viajes', 'descripcion' => 'Encargado de brindar asesoramiento y recomendaciones a los clientes sobre destinos y paquetes turísticos.', 'salario' => 2200, 'horario' => 8, 'area_id' => 1, 'n_jerarquico_id' => 3, 'f_registro' => now()],
            ['nombre' => 'Agente de Reservas', 'descripcion' => 'Encargado de realizar las reservas de vuelos, hoteles y otros servicios para los clientes.', 'salario' => 2000, 'horario' => 8, 'area_id' => 1, 'n_jerarquico_id' => 4, 'f_registro' => now()],
            ['nombre' => 'Fotógrafo de Viajes', 'descripcion' => 'Encargado de capturar imágenes y videos de los destinos y actividades turísticas para promocionar la agencia.', 'salario' => 1800, 'horario' => 6, 'area_id' => 2, 'n_jerarquico_id' => 4, 'f_registro' => now()],
            ['nombre' => 'Asistente Administrativo', 'descripcion' => 'Responsable de llevar a cabo tareas administrativas y de apoyo en la agencia.', 'salario' => 1600, 'horario' => 8, 'area_id' => 1, 'n_jerarquico_id' => 2, 'f_registro' => now()],
            ['nombre' => 'Analista de Marketing', 'descripcion' => 'Encargado de desarrollar estrategias de marketing y promoción para atraer a nuevos clientes.', 'salario' => 2400, 'horario' => 8, 'area_id' => 5, 'n_jerarquico_id' => 5, 'f_registro' => now()],
            ['nombre' => 'Contador', 'descripcion' => 'Responsable de llevar el registro y control de las finanzas y gastos de la agencia.', 'salario' => 2800, 'horario' => 8, 'area_id' => 1, 'n_jerarquico_id' => 5, 'f_registro' => now()],
            ['nombre' => 'Encargado de Redes Sociales', 'descripcion' => 'Responsable de gestionar y mantener la presencia de la agencia en las redes sociales.', 'salario' => 2000, 'horario' => 6, 'area_id' => 5, 'n_jerarquico_id' => 4, 'f_registro' => now()],
            ['nombre' => 'Agente de Atención al Cliente', 'descripcion' => 'Encargado de brindar atención y resolver consultas de los clientes.', 'salario' => 1800, 'horario' => 8, 'area_id' => 2, 'n_jerarquico_id' => 3, 'f_registro' => now()],
            ['nombre' => 'Guía', 'descripcion' => 'El Guía de Montaña es el profesional encargado de acompañar y asistir a los excursionistas y montañistas durante sus travesías en zonas montañosas. Su función es asegurar la seguridad de los participantes, proporcionar información sobre la ruta y .', 'salario' => 200, 'horario' => 8, 'area_id' => 4, 'n_jerarquico_id' => 4, 'f_registro' => now()],
            ['nombre' => 'Atención al Cliente', 'descripcion' => 'El área de Atención al Cliente se encarga de brindar un servicio de calidad y atención personalizada a los clientes que contactan con la agencia de viajes. Su objetivo es resolver dudas, proporcionar información sobre paquetes turístic deben tener habilidades de comunicación, empatía y capacidad para trabajar bajo presión.', 'salario' => 180, 'horario' => 8, 'area_id' => 2, 'n_jerarquico_id' => 4, 'f_registro' => now()],
            ['nombre' => 'Transporte', 'descripcion' => 'El área de Transporte se encarga de coordinar y gestionar los servicios de transporte necesarios para los clientes durante sus viajes. Esto incluye la reserva de vuelos, autobuses, trenes y otros medios de transporte, así como la coordinación esta área deben tener habilidades organizativas y capacidad para resolver posibles incidencias relacionadas con el transporte.', 'salario' => 190, 'horario' => 8, 'area_id' => 3, 'n_jerarquico_id' => 4, 'f_registro' => now()],



        ];
        Cargo::insert($cargos);
    }
}
