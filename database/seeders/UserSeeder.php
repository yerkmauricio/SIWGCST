<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'rudy mauricio',
            'email' => 'yerkmauricio@gmail.com',
            'password' => 'contraseña_segura_1' ,
            'empleado_id' => 1,
        ]);

        
        // Asignar el rol "administrador" a los usuarios si es necesario
        $role = Role::where('name', 'administrador')->first();

        if ($role) {
            $user1->assignRole($role);
          
        }
    }
}
