<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


use App\Models\User;
use App\Models\GntDirectorio;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'nick' => 'admin',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $admin->assignRole('admin');
        $gntDir = GntDirectorio::create([
            'user_id' => $admin->id,
            'name' => $admin->name,
            'email' => $admin->email,
            'ci' => '0',
            'celular' => '73682145',
            'telefono' => '69089055',
            'website' => '',
            'direccion' => 'C/ Isrrael Mendia, #5',
            'nit' => '8956887018',
            'razonsocial' => 'Soluciones LP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $admin = User::create([
            'name' => 'usuario',
            'email' => 'usuario@usuario.com',
            'nick' => 'usuarionick',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $admin->assignRole('ussers');
        $gntDir = GntDirectorio::create([
            'user_id' => $admin->id,
            'name' => $admin->name,
            'email' => $admin->email,
            'ci' => '0',
            'celular' => '73682145',
            'telefono' => '69089055',
            'website' => '',
            'direccion' => 'C/ Isrrael Mendia, #5',
            'nit' => '8956887018',
            'razonsocial' => 'Soluciones LP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}