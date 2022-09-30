<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name','ussers')->first();
        $role->givePermissionTo('usuario.store');
        $role->givePermissionTo('usuario.update');
        $role->givePermissionTo('usuario.show');
        $role->givePermissionTo('usuario.delete');

        $roles = Role::where('name','admin')->first();
        $roles->givePermissionTo('usuario.store');
        $roles->givePermissionTo('usuario.update');
        $roles->givePermissionTo('usuario.show');
        $roles->givePermissionTo('usuario.delete');
        $roles->givePermissionTo('tipousuario.store');
        $roles->givePermissionTo('tipousuario.update');
        $roles->givePermissionTo('tipousuario.show');
        $roles->givePermissionTo('tipousuario.delete');
        $roles->givePermissionTo('admin');
    }
}