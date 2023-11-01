<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        // llamando al metodo seeder de permisos
        $this->call(RoleSeeder::class);

        $this->call(AreaSeeder::class);
        $this->call(NJerarquicoSeeder::class);
        $this->call(CargoSeeder::class);
        $this->call(EmpleadosSeeder::class);
        // $this->call(AlimentosSeeder::class);
        // $this->call(DescuentoSeeder::class);
        // $this->call(DestinosSeeder::class);
        // $this->call(FotoTourSeeder::class);
        // $this->call(HospedajesSeeder::class);
        // $this->call(ProductoSeeder::class);
        // $this->call(LisaliSeeder::class);
        // $this->call(ObsIncludeSeeder::class);
        // $this->call(ObsNoincludeSeeder::class);
        // $this->call(TransporteSeeder::class);
        // $this->call(ToursSeeder::class);
        $this->call(UserSeeder::class);
    }
}
