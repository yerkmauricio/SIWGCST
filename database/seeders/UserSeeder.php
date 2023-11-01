<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = [
            [
                'name' => 'rudy mauricio', 'email' => 'yerkmauricio@gmail.com', 'password' => 12345678,
                'empleado_id' => 1,
            ],
            // [
            //     'name' => 'daysi llusco', 'email' => 'daysi@gmail.com', 'password' => 123,
            //     'empleado_id' => 7,
            // ]
        ];
        User::insert($usuarios);
    }
}
