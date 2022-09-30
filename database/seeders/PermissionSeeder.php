<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\RoleHasPermission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        //usuario
        Permission::create([
            'name' => 'usuario.store',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'usuario.update',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'usuario.delete',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'usuario.show',
            'guard_name' => 'web',
        ]);
        //tipo de usuario
        Permission::create([
            'name' => 'tipousuario.store',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'tipousuario.update',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'tipousuario.delete',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'tipousuario.show',
            'guard_name' => 'web',
        ]);        
        Permission::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
    }
}