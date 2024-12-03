<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EdicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('edicion')->insert([
            'nombre_edicion' => 'Edición Personalizada',
            'descripcion' => 'Edición personalizada',
            'fecha_de_salida' => Carbon::now()->format('Y-m-d'),
            'lote' => 0,
            'existencias' => 0,
            'extra' => 0,
            'tipo' => 'Personalizada',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
