<?php

namespace Database\Seeders;

use App\Models\Sala;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sala::create([
            'nombre' => "Adentro",
            'descripcion' => "Patio de la rockola",
            'token'=>Str::uuid(),
            'sucursal_id' => 1,
        ]);

        Sala::create([
            'nombre' => "Afuera",
            'descripcion' => "Bar de la rockola",
            'token'=>Str::uuid(),
            'sucursal_id' => 1,
        ]);
        
    }
}
