<?php

namespace Database\Seeders;

use App\Models\Productos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            ['nombre' => 'pipoca', 'tipo' => 'snack', 'precio' => 4, 'descripcion' => 'Deliciosa pipoca', 'categoria' => 'unidad', 'cantidad' => 1, 'foto' => asset('img/productos/pipoca.jpg'), 'f_registro' => now()],
            ['nombre' => 'fideo', 'tipo' => 'carne', 'precio' => 7, 'descripcion' => 'Fideos para cocinar', 'categoria' => 'kilo', 'cantidad' => 1, 'foto' => asset('img/productos/fideo.jpg'), 'f_registro' => now()],
            ['nombre' => 'azucar', 'tipo' => 'dulce', 'precio' => 3, 'descripcion' => 'Azúcar refinada', 'categoria' => 'kilo', 'cantidad' => 1, 'foto' => 'img/productos/azucar.jpg', 'f_registro' => now()],
            ['nombre' => 'arroz', 'tipo' => 'grano', 'precio' => 3.5, 'descripcion' => 'Arroz blanco', 'categoria' => 'kilo', 'cantidad' => 1, 'foto' => 'img/productos/arroz.jpg', 'f_registro' => now()],
            ['nombre' => 'aceite', 'tipo' => 'grasa', 'precio' => 7.5, 'descripcion' => 'Aceite de oliva', 'categoria' => 'litro', 'cantidad' => 1, 'foto' => 'img/productos/aceite.jpg', 'f_registro' => now()],
            ['nombre' => 'sopa', 'tipo' => 'snack', 'precio' => 10, 'descripcion' => 'Sopa instantánea', 'categoria' => 'unidad', 'cantidad' => 1, 'foto' => 'img/productos/sopa.jpg', 'f_registro' => now()],
            ['nombre' => 'pasta', 'tipo' => 'carbohidrato', 'precio' => 7.5, 'descripcion' => 'Pasta de trigo', 'categoria' => 'kilo', 'cantidad' => 1, 'foto' => 'img/productos/pasta.jpg', 'f_registro' => now()],
            ['nombre' => 'pomarolla', 'tipo' => 'salsa', 'precio' => 5, 'descripcion' => 'Salsa de tomate', 'categoria' => 'litro', 'cantidad' => 1, 'foto' => 'img/productos/pomarolla.jpg', 'f_registro' => now()],
            ['nombre' => 'carne de soya', 'tipo' => 'proteína', 'precio' => 5, 'descripcion' => 'Carne vegetal', 'categoria' => 'kilo', 'cantidad' => 1, 'foto' => 'img/productos/carne_soya.jpg', 'f_registro' => now()],
            ['nombre' => 'bandeja de galleta', 'tipo' => 'snack', 'precio' => 11, 'descripcion' => 'Bandeja de galletas surtidas', 'categoria' => 'unidad', 'cantidad' => 1, 'foto' => 'img/productos/galletas.jpg', 'f_registro' => now()],
            ['nombre' => 'craker', 'tipo' => 'snack', 'precio' => 10, 'descripcion' => 'Crackers salados', 'categoria' => 'unidad', 'cantidad' => 1, 'foto' => 'img/productos/craker.jpg', 'f_registro' => now()],
            ['nombre' => 'mantequilla', 'tipo' => 'lácteo', 'precio' => 16, 'descripcion' => 'Mantequilla natural', 'categoria' => 'kilo', 'cantidad' => 1, 'foto' => 'img/productos/mantequilla.jpg', 'f_registro' => now()],
            ['nombre' => 'dulce de leche', 'tipo' => 'dulce', 'precio' => 10, 'descripcion' => 'Dulce de leche tradicional', 'categoria' => 'kilo', 'cantidad' => 1, 'foto' => 'img/productos/dulce_leche.jpg', 'f_registro' => now()],
            ['nombre' => 'mate', 'tipo' => 'bebida', 'precio' => 2.5, 'descripcion' => 'Yerba mate', 'categoria' => 'kilo', 'cantidad' => 1, 'foto' => 'img/productos/mate.jpg', 'f_registro' => now()],
            ['nombre' => 'leche', 'tipo' => 'lácteo', 'precio' => 26, 'descripcion' => 'Leche fresca', 'categoria' => 'litro', 'cantidad' => 1, 'foto' => 'img/productos/leche.jpg', 'f_registro' => now()],
            ['nombre' => 'tody', 'tipo' => 'bebida', 'precio' => 9, 'descripcion' => 'Bebida en polvo sabor chocolate', 'categoria' => 'unidad', 'cantidad' => 1, 'foto' => 'img/productos/tody.jpg', 'f_registro' => now()],
            ['nombre' => 'gramola', 'tipo' => 'snack', 'precio' => 7, 'descripcion' => 'Snack salado', 'categoria' => 'unidad', 'cantidad' => 1, 'foto' => 'img/productos/gramola.jpg', 'f_registro' => now()],
            ['nombre' => 'yogurt', 'tipo' => 'lácteo', 'precio' => 13, 'descripcion' => 'Yogurt natural', 'categoria' => 'unidad', 'cantidad' => 1, 'foto' => 'img/productos/yogurt.jpg', 'f_registro' => now()],
            ['nombre' => 'mayonesa', 'tipo' => 'salsa', 'precio' => 8, 'descripcion' => 'Mayonesa de calidad', 'categoria' => 'litro', 'cantidad' => 1, 'foto' => 'img/productos/mayonesa.jpg', 'f_registro' => now()],
            ['nombre' => 'ketchup', 'tipo' => 'salsa', 'precio' => 7, 'descripcion' => 'Ketchup para acompañar', 'categoria' => 'litro', 'cantidad' => 1, 'foto' => 'img/productos/ketchup.jpg', 'f_registro' => now()],
            ['nombre' => 'condimento', 'tipo' => 'especia', 'precio' => 5, 'descripcion' => 'Condimentos variados', 'categoria' => 'unidad', 'cantidad' => 1, 'foto' => 'img/productos/condimento.jpg', 'f_registro' => now()],
            ['nombre' => 'sevilleta', 'tipo' => 'accesorio', 'precio' => 2, 'descripcion' => 'Servilletas de papel', 'categoria' => 'unidad', 'cantidad' => 1, 'foto' => 'img/productos/sevilleta.jpg', 'f_registro' => now()],
            ['nombre' => 'zuko', 'tipo' => 'bebida', 'precio' => 3, 'descripcion' => 'Polvo para preparar bebida saborizada', 'categoria' => 'unidad', 'cantidad' => 1, 'foto' => 'img/productos/zuko.jpg', 'f_registro' => now()],
            ['nombre' => 'durazno', 'tipo' => 'fruta', 'precio' => 17, 'descripcion' => 'Durazno en almíbar', 'categoria' => 'unidad', 'cantidad' => 1, 'foto' => 'img/productos/durazno.jpg', 'f_registro' => now()],
            ['nombre' => 'queque', 'tipo' => 'repostería', 'precio' => 17, 'descripcion' => 'Queque de vainilla', 'categoria' => 'unidad', 'cantidad' => 1, 'foto' => 'img/productos/queque.jpg', 'f_registro' => now()],
            ['nombre' => 'quinua', 'tipo' => 'grano', 'precio' => 6, 'descripcion' => 'Grano de quinua', 'categoria' => 'kilo', 'cantidad' => 1, 'foto' => 'img/productos/quinua.jpg', 'f_registro' => now()],
            ['nombre' => 'pan molido', 'tipo' => 'harina', 'precio' => 2.5, 'descripcion' => 'Pan molido para empanizar', 'categoria' => 'kilo', 'cantidad' => 1, 'foto' => 'img/productos/pan_molido.jpg', 'f_registro' => now()],
        ];

        Productos::insert($productos);
    }
}
