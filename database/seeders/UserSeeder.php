<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = [
            [
                'name' => 'rudy mauricio', 'email' => 'yerkmauricio@gmail.com',
                'password' => hash::make('contraseña_segura'), // Genera una contraseña segura
                'empleado_id' => 1,
            ],
            [
                'name' => 'daysi llusco', 'email' => 'daysi@gmail.com',
                'password' => Hash::make('otra_contraseña_segura'), // Genera otra contraseña segura
                'empleado_id' => 2,
            ]
        ];
        User::insert($usuarios);
    }
}
