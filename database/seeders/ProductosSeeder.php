<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $tamaños = ['CH', 'M', 'XL', 'XXL'];
        $colores = ['Blanco', 'Negro', 'Azul', 'Rojo', 'Verde', 'Amarillo', 'Gris'];

        for ($i = 0; $i < 20; $i++) {
            DB::table('productos')->insert([
                'tipo' => $faker->words(2, true) . ' Playera',
                'tamaño' => $faker->randomElement($tamaños),
                'color' => $faker->randomElement($colores),
                'lote' => $faker->numberBetween(10, 100),
                'costo' => $faker->randomFloat(2, 100, 500),
                'imagen_producto' => $faker->imageUrl(300, 300, 'fashion', true, 'Playera'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
