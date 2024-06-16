<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::firstOrCreate(['name' => 'Admin']);
        $role2 = Role::firstOrCreate(['name' => 'Editor']);

        Permission::firstOrCreate(['name' => 'users.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'users.create'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'users.edit'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'users.delete'])->syncRoles([$role1, $role2]);

        Permission::firstOrCreate(['name' => 'roles.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'roles.create'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'roles.edit'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'roles.delete'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'permissions.index'])->syncRoles([$role1, $role2]);

        Permission::firstOrCreate(['name' => 'sucursales.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'sucursales.create'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'sucursales.edit'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'sucursales.delete'])->syncRoles([$role1, $role2]);

        Permission::firstOrCreate(['name' => 'salas.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'salas.create'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'salas.edit'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'salas.delete'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'salas.playlist'])->syncRoles([$role1, $role2]);

        Permission::firstOrCreate(['name' => 'mesas.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'mesas.create'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'mesas.edit'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'mesas.delete'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'mesas.pedidos'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'mesas.qr'])->syncRoles([$role1, $role2]);

        Permission::firstOrCreate(['name' => 'videos.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'videos.create'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'videos.edit'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'videos.delete'])->syncRoles([$role1, $role2]);

        Permission::firstOrCreate(['name' => 'pedidos.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'pedidos.create'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'pedidos.edit'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'pedidos.delete'])->syncRoles([$role1, $role2]);
    }
}
