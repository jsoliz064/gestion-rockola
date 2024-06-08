<?php

namespace Database\Seeders;

use App\Models\Sala;
use Illuminate\Database\Seeder;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Sala::create([
            'nombre' => "Adentro",
            'descripcion' => "Patio de la rockola",
            'sucursal_id' => 1,
        ]);

        $p1 = Sala::create([
            'nombre' => "Afuera",
            'descripcion' => "Bar de la rockola",
            'sucursal_id' => 1,
        ]);

        $p1 = Sala::create([
            'nombre' => "Adentro",
            'descripcion' => "Patio de la rockola",
            'sucursal_id' => 2,
        ]);

        $p1 = Sala::create([
            'nombre' => "Afuera",
            'descripcion' => "Bar de la rockola",
            'sucursal_id' => 2,
        ]);
    }
}
