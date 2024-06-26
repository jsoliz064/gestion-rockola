<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SucursalSeeder::class);
        $this->call(SalaSeeder::class);
        $this->call(MesaSeeder::class);
        $this->call(VideoSeeder::class);
    }
}
