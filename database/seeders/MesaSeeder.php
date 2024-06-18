<?php

namespace Database\Seeders;

use App\Models\Mesa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mesa::create([
            'nombre' => "Mesa 1",
            'sala_id' => 1,
        ]);

        Mesa::create([
            'nombre' => "Mesa 2",
            'sala_id' => 1,
        ]);

        Mesa::create([
            'nombre' => "Mesa 3",
            'sala_id' => 2,
        ]);

        Mesa::create([
            'nombre' => "Mesa 4",
            'sala_id' => 2,
        ]);

        Mesa::create([
            'nombre' => "Mesa 1",
            'sala_id' => 3,
        ]);

        Mesa::create([
            'nombre' => "Mesa 2",
            'sala_id' => 4,
        ]);
    }
}
