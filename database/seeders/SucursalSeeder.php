<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sucursal::create([
            'nombre' => "Primavera",
            'direccion' => "5to anillo",
        ]);

        Sucursal::create([
            'nombre' => "San Aurelio",
            'direccion' => "4to anillo",
        ]);
    }
}
